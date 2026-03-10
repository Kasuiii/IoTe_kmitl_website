<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
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

    protected $casts = [
        'is_staff' => 'boolean',
    ];

    public function getResearchInterestsArrayAttribute(): array
    {
        if (!$this->research_interests) return [];
        return array_map('trim', explode(',', $this->research_interests));
    }

    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->prefix) {
            'professor'   => 'ศาสตราจารย์ (Professor)',
            'assoc_prof'  => 'รองศาสตราจารย์ (Assoc. Prof.)',
            'asst_prof'   => 'ผู้ช่วยศาสตราจารย์ (Asst. Prof.)',
            'lecturer'    => 'อาจารย์ (Lecturer)',
            default       => $this->prefix ? ucfirst($this->prefix) : 'ไม่ระบุตำแหน่ง',
        };
    }
    public function educations()
    {
        return $this->hasMany(FacultyEducation::class)
            ->orderBy('sort_order')
            ->orderBy('year');
    }
}
