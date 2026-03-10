<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Show course list
    public function index()
    {
        $courses = course::orderBy('courseYear', 'desc')
            ->orderBy('courseID', 'asc')
            ->get();

        return view('courses.index', compact('courses'));
    }

    // Show add form
    public function create()
    {
        return view('courses.add_course');
    }

    // Save new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'courseYear'     => 'required|integer|min:1|max:4',
            'courseID'       => 'required|string|max:20|unique:course,courseID', // unique check
            'courseName'     => 'required|string|max:255',
            'courseCredit'   => 'required|integer|min:1|max:3',
            'courseType'     => 'required|string|max:50',
            'courseDescript' => 'nullable|string|max:500',
            'courseSemester' => 'required|string|min:1|max:3',
            'courseDegree'   => 'required|string|max:255',
        ]);

        course::create($validated);

        return redirect()->route('course.index')
            ->with('success', 'Course added successfully!');
    }

    // Show edit form
    public function edit($courseID)
    {
        $course = course::findOrFail($courseID);
        return view('courses.edit_course', compact('course'));
    }

    // Update course
    public function update(Request $request, $courseID)
    {
        $validated = $request->validate([
            'courseYear'     => 'required|integer|min:1|max:4',
            'courseName'     => 'required|string|max:255',
            'courseCredit'   => 'required|integer|min:0|max:20',
            'courseType'     => 'required|string|max:50',
            'courseDescript' => 'nullable|string|max:500',
            'courseSemester' => 'required|string|max:10',
            'courseDegree'   => 'required|string|max:255',
        ]);

        $course = course::findOrFail($courseID);
        $course->update($validated);

        return redirect()->route('course.index')
            ->with('success', 'Course updated successfully!');
    }

    // Delete course
    public function destroy($courseID)
    {
        $course = course::findOrFail($courseID);
        $course->delete();

        return redirect()->route('course.index')
            ->with('success', 'Course deleted successfully!');
    }
}
