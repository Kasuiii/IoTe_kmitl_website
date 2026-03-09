<?php

// ═══════════════════════════════════════════════════════════════
// FILE: app/Models/FacultyMember.php
// ═══════════════════════════════════════════════════════════════
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    // "fillable" = which fields are allowed to be mass-assigned
    // (prevents accidentally saving fields you didn't intend to)
    protected $fillable = [
        'prefix',
        'name_th',
        'name_en',
        'position',
        'role',
        'email',
        'phone',
        'research_interests',
        'study_paths',
        'photo_url',
        'office_location',
        'bio',
        'is_staff',
        'sort_order',
    ];

    // "cast" tells Laravel to automatically convert JSON strings ↔ PHP arrays
    protected $casts = [
        'is_staff' => 'boolean',
    ];

    /**
     * Get research_interests as an array (split by comma)
     */
    public function getResearchInterestsArrayAttribute(): array
    {
        if (!$this->research_interests) return [];
        return array_map('trim', explode(',', $this->research_interests));
    }

    /**
     * Scope: filter by role (used in admin list)
     * Usage: FacultyMember::byRole('professor')->get()
     */
    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Human-readable role label
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'professor'   => 'ศาสตราจารย์ (Professor)',
            'assoc_prof'  => 'รองศาสตราจารย์ (Assoc. Prof.)',
            'asst_prof'   => 'ผู้ช่วยศาสตราจารย์ (Asst. Prof.)',
            'lecturer'    => 'อาจารย์ (Lecturer)',
            default       => $this->role,
        };
    }
    public function educations()
    {
        return $this->hasMany(FacultyEducation::class)
            ->orderBy('sort_order')
            ->orderBy('year');
    }
}
