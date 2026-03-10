@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('title', 'Add Course')
@section('content')
    <div class="max-w-xl mt-8 p-6 bg-white rounded-lg shadow mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Add Course</h2>
        @if ($errors->any())
            <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 16px">
                <ul style="margin: 0; padding-left: 16px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('course.store') }}" class="gap-4 flex flex-col">
            @csrf

            <div>
                <label>Year</label>
                <select name="courseYear" class="rounded px-3 py-2 w-full border" required>
                    <option value="" @selected(! old('courseYear'))>Choose a year</option>
                    <option value="1" @selected(old('courseYear') == '1')>1</option>
                    <option value="2" @selected(old('courseYear') == '2')>2</option>
                    <option value="3" @selected(old('courseYear') == '3')>3</option>
                    <option value="4" @selected(old('courseYear') == '4')>4</option>
                </select>
            </div>

            <div>
                <label>Course ID</label>
                <input name="courseID" type="text" value="{{ old('courseID') }}" class="rounded px-3 py-2 w-full border" required />
            </div>

            <div>
                <label>Name</label>
                <textarea name="courseName" class="rounded px-3 py-2 w-full border" required>{{ old('courseName') }}</textarea>
            </div>

            <div>
                <label>Credits</label>
                {{-- FIX: was "courseCredits" (with s) — controller & model expect "courseCredit" --}}
                <select name="courseCredit" class="rounded px-3 py-2 w-full border" required>
                    <option value="" @selected(! old('courseCredit'))>Choose a Credits</option>
                    <option value="1" @selected(old('courseCredit') == '1')>1</option>
                    <option value="2" @selected(old('courseCredit') == '2')>2</option>
                    <option value="3" @selected(old('courseCredit') == '3')>3</option>
                </select>
            </div>

            <div>
                <label>Type</label>
                <select name="courseType" class="rounded px-3 py-2 w-full border" required>
                    <option value="" @selected(! old('courseType'))>Choose a course type</option>
                    <option value="Core" @selected(old('courseType') == 'Core')>Core</option>
                    <option value="Elective" @selected(old('courseType') == 'Elective')>Elective</option>
                    <option value="Lab" @selected(old('courseType') == 'Lab')>Lab</option>
                    <option value="Gen" @selected(old('courseType') == 'Gen')>General</option>
                </select>
            </div>

            <div>
                <label>Description</label>
                <input name="courseDescript" type="text" value="{{ old('courseDescript') }}" class="rounded px-3 py-2 w-full border" />
            </div>

            <div>
                <label>Semester</label>
                <select name="courseSemester" class="rounded px-3 py-2 w-full border" required>
                    <option value="" @selected(! old('courseSemester'))>Choose a semester</option>
                    <option value="1" @selected(old('courseSemester') == '1')>1</option>
                    <option value="2" @selected(old('courseSemester') == '2')>2</option>
                    <option value="3" @selected(old('courseSemester') == '3')>3</option>
                </select>
            </div>

            <div>
                <label>Degree</label>
                <select name="courseDegree" class="rounded px-3 py-2 w-full border" required>
                    <option value="" @selected(! old('courseDegree'))>Choose a degree</option>
                    <option value="One" @selected(old('courseDegree') == 'One')>One</option>
                    <option value="Dual" @selected(old('courseDegree') == 'Dual')>Dual</option>
                </select>
            </div>

            <div class="gap-4 mt-2 flex">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Add Course</button>
                <a href="{{ route('course.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Cancel</a>
            </div>
        </form>
    </div>
@endsection
