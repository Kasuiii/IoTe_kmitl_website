<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'courseID';
    protected $keyType = 'string';
    protected $fillable = ['courseYear', 'courseID', 'courseName', 'courseCredit', 'courseType', 'courseDescript', 'courseSemester', 'courseDegree'];

    public $incrementing = false;
    public $timestamps = false;

    use HasFactory;
}
