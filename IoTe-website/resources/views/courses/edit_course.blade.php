@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('title', 'Edit Course')
@section('content')
    <body>
        <h2 style="text-align: center">Edit Course: {{ $course->courseID }}</h2>
        <form method="POST" action="/courses/{{ $course->courseID }}" style="width: 400px; margin: 0 auto">
            @csrf
            @method('PUT')
            <p>
                Year:
                <input name="courseYear" type="text" value="{{ $course->courseYear }}" required />
            </p>
            <p>
                ID:
                <input type="text" value="{{ $course->courseID }}" disabled />
            </p>
            <p>
                Name:
                <textarea name="courseName" required>{{ $course->courseName }}</textarea>
            </p>
            <p>
                Credits:
                <input name="courseCredit" type="text" value="{{ $course->courseCredit }}" required />
            </p>
            <p>
                Type:
                <input name="courseType" type="text" value="{{ $course->courseType }}" required />
            </p>
            <p>
                Description:
                <input name="courseDescript" type="text" value="{{ $course->courseDescript }}" />
            </p>
            <p>
                Semester:
                <input name="courseSemester" type="text" value="{{ $course->courseSemester }}" required />
            </p>
            <button type="submit">Update</button>
            <a href="{{ route('course.index') }}" class="Cancel_edit {{ request()->routeIs('course.index') ? 'active' : '' }}">Cancel</a>
        </form>
    </body>
@endsection
