@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('title', 'Add Course')
@section('content')
    <div class="max-w-xl mt-8 p-6 bg-white rounded-lg shadow mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Add Course</h2>

        {{-- Show validation errors --}}
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
                <select name="courseYear" type="number" value="{{ old('courseYear') }}" class="rounded px-3 py-2 w-full border" required>
                    <option selected>Choose a year</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                {{-- <input name="courseYear" type="number" value="{{ old('courseYear') }}" class="rounded px-3 py-2 w-full border" required /> --}}
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
                <select
                    name="courseCredits"
                    type="number"
                    value="{{ old('courseCredits') }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                >
                    <option selected>Choose a Credits</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                {{--
                    <input
                    name="courseCredit"
                    type="number"
                    value="{{ old('courseCredit') }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                    />
                --}}
            </div>

            <div>
                <label>Type</label>
                <select name="courseType" type="text" value="{{ old('courseType') }}" class="rounded px-3 py-2 w-full border" required>
                    <option selected>Choose a course type</option>
                    <option value="Core">Core</option>
                    <option value="Elective">Elective</option>
                    <option value="Lab">Lab</option>
                    <option value="Gen">General</option>
                </select>
                {{-- <input name="courseType" type="text" value="{{ old('courseType') }}" class="rounded px-3 py-2 w-full border" required /> --}}
            </div>

            <div>
                <label>Description</label>
                <input name="courseDescript" type="text" value="{{ old('courseDescript') }}" class="rounded px-3 py-2 w-full border" />
            </div>

            <div>
                <label>Semester</label>
                <select
                    name="courseSemester"
                    type="text"
                    value="{{ old('courseSemester') }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                >
                    <option selected>Choose a semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                {{--
                    <input
                    name="courseSemester"
                    type="text"
                    value="{{ old('courseSemester') }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                    />
                --}}
            </div>
            <div>
                <label>Degree</label>
                <select name="courseDegree" type="text" value="{{ old('courseDegree') }}" class="rounded px-3 py-2 w-full border" required>
                    <option selected>Choose a degree</option>
                    <option value="One">One</option>
                    <option value="Dual">Dual</option>
                </select>
                {{--
                    <input
                    name="courseDegree"
                    type="text"
                    value="{{ old('courseDegree') }}"
                    class="rounded px-3 py-2 w-full border"
                    required
                    />
                --}}
            </div>

            <div class="gap-4 mt-2 flex">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Add Course</button>
                <a href="{{ route('course.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Cancel</a>
            </div>
        </form>
    </div>
@endsection
