@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('title', 'Add Course')
@section('content')
    <body>
        <h2 style="text-align: center">All Courses</h2>

        @if (session('success'))
            <div style="color: green; text-align: center">{{ session('success') }}</div>
        @endif

        <table border="1" align="center" cellpadding="5">
            <tr>
                <th>Year</th>
                <th>ID</th>
                <th>Name</th>
                <th>Credits</th>
                <th>Description</th>
                <th>Semester</th>
                <th>Actions</th>
            </tr>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->courseYear }}</td>
                    <td>{{ $course->courseID }}</td>
                    <td>{{ $course->courseName }}</td>
                    <td>{{ $course->courseCredit }}</td>
                    <td>{{ $course->courseDescript }}</td>
                    <td>{{ $course->courseSemester }}</td>
                    <td>
                        <a href="/courses/{{ $course->courseID }}/edit">Edit</a>
                        <form action="/courses/{{ $course->courseID }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red" onclick="return confirm('Delete course?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div style="text-align: center; margin-top: 20px"><a href="/add_course">Add New Course</a></div>
    </body>
@endsection
