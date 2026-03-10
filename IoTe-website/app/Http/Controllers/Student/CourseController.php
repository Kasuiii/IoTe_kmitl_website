<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->is_student) {
            return view('student.courses.index', [
                'courses'   => collect(),
                'user'      => $user,
                'bySemester' => [],
                'isStudent' => false,
            ]);
        }

        $studentYear  = $user->student_year;   // 1, 2, 3, or 4
        $facultyCode  = $user->faculty_code;   // '01' or '05'
        $courses = Course::forFaculty($facultyCode)
            ->where('year_level', $studentYear)
            ->orderBy('semester')
            ->orderBy('course_code')
            ->get();

        $bySemester = $courses->groupBy('semester');

        return view('student.courses.index', compact('courses', 'user', 'bySemester'));
    }
}
