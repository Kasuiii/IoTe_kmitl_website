<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function create()
    {
        return view('test');
    }

    //view
    public function index()
    {
        $courses = course::all();
        return view('courses/course_list', compact('courses')); //pass data as array
    }

    //create
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'courseYear' => 'required|integer',
            'courseID' => 'required|string|max:20',
            'courseName' => 'required|string|max:255',
            'courseCredit' => 'required|integer',
            'courseType' => 'required|string|max:50',
            'courseDescript' => 'nullable|string',
            'courseSemester' => 'required|string|max:10'
        ]);

        course::create([
            'courseYear' => $validatedData['courseYear'],
            'courseID' => $validatedData['courseID'],
            'courseName' => $validatedData['courseName'],
            'courseCredit' => $validatedData['courseCredit'],
            'courseType' => $validatedData['courseType'],
            'courseDescript' => $validatedData['courseDescript'] ?? null,
            'courseSemester' => $validatedData['courseSemester']
        ]);

        return redirect('/courses/course_list')->with('success', 'Course added successfully!');
    }

    //edit
    public function edit($courseID)
    {
        $course = course::findOrFail($courseID);
        return view('courses/edit_course', compact('course'));
    }

    //update
    public function update(Request $request, $courseID)
    {
        $validatedData = $request->validate([
            'courseYear' => 'required|integer',
            'courseName' => 'required|string|max:255',
            'courseCredit' => 'required|integer',
            'courseType' => 'required|string|max:50',
            'courseDescript' => 'nullable|string',
            'courseSemester' => 'required|string|max:10'
        ]);

        $course = course::findOrFail($courseID);
        $course->update($validatedData);

        return redirect('/courses/course_list')->with('success', 'Course updated successfully!');
    }

    //delete
    public function destroy($courseID)
    {
        $course = course::findOrFail($courseID);
        $course->delete();
        return redirect('/courses/course_list')->with('success', 'Course deleted successfully!');
    }
}
