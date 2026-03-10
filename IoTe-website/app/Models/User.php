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
    public function getStudentNumberAttribute(): ?string
    {
        $local = explode('@', $this->email)[0];
        return is_numeric($local) && strlen($local) === 8 ? $local : null;
    }
    public function getAdmissionYearCodeAttribute(): ?string
    {
        return $this->student_number ? substr($this->student_number, 0, 2) : null;
    }

    public function getFacultyCodeAttribute(): ?string
    {
        return $this->student_number ? substr($this->student_number, 2, 2) : null;
    }

    public function getPersonalIdAttribute(): ?string
    {
        return $this->student_number ? substr($this->student_number, 4, 4) : null;
    }
    public function getStudentYearAttribute(): ?int
    {
        $code = $this->admission_year_code;
        if (!$code) return null;

        $now = now();

        $currentAcademicYearStart = $now->month >= 7 ? $now->year : $now->year - 1;

        $entryYearAD = 2500 + (int)$code;

        $year = $currentAcademicYearStart - $entryYearAD + 1;

        return max(1, $year);
    }

    public function getFacultyNameAttribute(): string
    {
        return match ($this->faculty_code) {
            '01' => 'Engineering (วิศวกรรมศาสตร์)',
            '05' => 'Science / Dual Degree (วิทยาศาสตร์)',
            default => 'Unknown',
        };
    }
    public function getIsStudentAttribute(): bool
    {
        return $this->student_number !== null;
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function enrolledCourses()
    {
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
