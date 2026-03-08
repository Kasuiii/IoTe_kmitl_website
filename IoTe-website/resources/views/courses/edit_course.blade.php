@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('title', 'Edit Course')
@section('content')
    <div class="max-w-xl mt-8 p-6 bg-white rounded-lg shadow mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Edit Course: {{ $course->courseID }}</h2>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 16px">
                <ul style="margin: 0; padding-left: 16px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('course.update', $course->courseID) }}" class="gap-4 flex flex-col">
            @csrf
            @method('PUT')

            <div>
                <label>Year</label>
                <input
                    name="courseYear"
                    type="number"
                    value="{{ old('courseYear', $course->courseYear) }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                />
            </div>

            <div>
                <label>Course ID</label>
                {{-- Disabled so it can't be changed --}}
                <input type="text" value="{{ $course->courseID }}" class="rounded px-3 py-2 bg-gray-100 w-full border" disabled />
            </div>

            <div>
                <label>Name</label>
                <textarea name="courseName" class="rounded px-3 py-2 w-full border" required>
{{ old('courseName', $course->courseName) }}</textarea
                >
            </div>

            <div>
                <label>Credits</label>
                <input
                    name="courseCredit"
                    type="number"
                    value="{{ old('courseCredit', $course->courseCredit) }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                />
            </div>

            <div>
                <label>Type</label>
                <input
                    name="courseType"
                    type="text"
                    value="{{ old('courseType', $course->courseType) }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                />
            </div>

            <div>
                <label>Description</label>
                <input
                    name="courseDescript"
                    type="text"
                    value="{{ old('courseDescript', $course->courseDescript) }}"
                    class="rounded px-3 py-2 w-full border"
                />
            </div>

            <div>
                <label>Semester</label>
                <input
                    name="courseSemester"
                    type="text"
                    value="{{ old('courseSemester', $course->courseSemester) }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                />
            </div>
            <div>
                <label>Degree</label>
                <input
                    name="courseDegree"
                    type="text"
                    value="{{ old('courseDegree', $course->courseDegree) }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                />
            </div>
            <div class="gap-4 mt-2 flex">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update Course</button>
                <a href="{{ route('course.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Cancel</a>
            </div>
        </form>
    </div>
@endsection
