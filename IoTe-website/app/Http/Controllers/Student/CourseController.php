<?php
// ═══════════════════════════════════════════════════
// FILE: app/Http/Controllers/Student/CourseController.php
// Shows a student their courses based on their email
// ═══════════════════════════════════════════════════
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // STEP 1: Parse the student's info from their email
        // ─────────────────────────────────────────────────
        // If email is 67050047@kmitl.ac.th:
        //   student_year = 2  (computed by User model, explained there)
        //   faculty_code = '05' (science)
        //
        // If the user is NOT a student (no numeric email), show nothing
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

        // STEP 2: Get courses that match this student's year AND faculty
        // ─────────────────────────────────────────────────────────────
        // forFaculty() scope: returns courses where faculty_code = 'all' OR matches their code
        // forYearSemester() is available if needed, but here we show ALL semesters for their year
        $courses = Course::forFaculty($facultyCode)
            ->where('year_level', $studentYear)
            ->orderBy('semester')
            ->orderBy('course_code')
            ->get();

        // STEP 3: Group by semester for clean display
        // ─────────────────────────────────────────────
        // Result: ['1' => [course, course...], '2' => [course, course...]]
        $bySemester = $courses->groupBy('semester');

        return view('student.courses.index', compact('courses', 'user', 'bySemester'));
    }
}
