<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyEducation extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'faculty_member_id',
        'degree',
        'field',
        'university',
        'country',
        'year',
        'sort_order',
    ];

    public function faculty()
    {
        return $this->belongsTo(FacultyMember::class, 'faculty_member_id');
    }
}
