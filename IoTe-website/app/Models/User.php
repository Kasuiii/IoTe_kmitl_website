<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Get the 8-digit student number from email (e.g. "67050047")
     */
    public function getStudentNumberAttribute(): ?string
    {
        $local = explode('@', $this->email)[0];
        return is_numeric($local) && strlen($local) === 8 ? $local : null;
    }
    /**
     * Get admission year digits, e.g. "67"
     */
    public function getAdmissionYearCodeAttribute(): ?string
    {
        return $this->student_number ? substr($this->student_number, 0, 2) : null;
    }

    /**
     * Get faculty code: "01" = Engineering, "05" = Science
     */
    public function getFacultyCodeAttribute(): ?string
    {
        return $this->student_number ? substr($this->student_number, 2, 2) : null;
    }

    /**
     * Get personal 4-digit ID, e.g. "0047"
     */
    public function getPersonalIdAttribute(): ?string
    {
        return $this->student_number ? substr($this->student_number, 4, 4) : null;
    }
    public function getStudentYearAttribute(): ?int
    {
        $code = $this->admission_year_code;
        if (!$code) return null;

        $now = now();

        // Current academic year starts in July
        // If we're before July, academic year started last year
        $currentAcademicYearStart = $now->month >= 7 ? $now->year : $now->year - 1;

        // Entry year in AD: "67" means Buddhist 2567 = 2024 AD
        $entryYearAD = 2500 + (int)$code;

        $year = $currentAcademicYearStart - $entryYearAD + 1;

        return max(1, $year); // minimum year 1
    }

    /**
     * Get readable faculty name
     */
    public function getFacultyNameAttribute(): string
    {
        return match ($this->faculty_code) {
            '01' => 'Engineering (วิศวกรรมศาสตร์)',
            '05' => 'Science / Dual Degree (วิทยาศาสตร์)',
            default => 'Unknown',
        };
    }
    /**
     * Is this a real student? (has 8-digit numeric email prefix)
     */
    public function getIsStudentAttribute(): bool
    {
        return $this->student_number !== null;
    }

    // ══════════════════════════════════════════════════════════
    // RELATIONSHIPS
    // "hasMany" means: one user can have many of these records
    // ══════════════════════════════════════════════════════════

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function enrolledCourses()
    {
        // Through the pivot table user_course_enrollments
        return $this->belongsToMany(Course::class, 'user_course_enrollments')
            ->withPivot('academic_year', 'semester', 'grade')
            ->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMember(): bool
    {
        return $this->role === 'member';
    }
}
