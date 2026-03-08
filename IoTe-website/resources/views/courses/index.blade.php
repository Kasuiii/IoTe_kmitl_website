@extends('layouts.app')
@section('title', 'Course List')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('content')
    {{-- Flash messages --}}
    @if (session('success'))
        <div style="background: #dcfce7; color: #16a34a; padding: 12px; border-radius: 8px; margin-bottom: 16px; text-align: center">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="rounded-base border-default bg-neutral-primary-soft px-5 py-5 shadow-xs relative overflow-x-auto border">
        <div class="m-3 flex items-center justify-between">
            <h1 class="text-xl font-bold">Course List</h1>

            {{-- Only admin sees Add Course button --}}
            @if (auth()->user()->isAdmin())
                <a
                    href="{{ route('course.create') }}"
                    class="rounded-md bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600"
                >
                    + Add Course
                </a>
            @endif
        </div>

        <table class="text-sm text-body w-full text-left">
            <thead class="border-default-medium bg-neutral-secondary-medium text-sm border-b">
                <tr>
                    <th class="px-6 py-3">Year</th>
                    <th class="px-6 py-3">ID</th>
                    {{-- Fixed typo "IDr" --}}
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Credits</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Semester</th>
                    <th class="px-6 py-3">Degree</th>
                    {{-- Was missing from header --}}
                    @if (auth()->user()->isAdmin())
                        <th class="px-6 py-3">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr class="border-default bg-neutral-primary-soft hover:bg-neutral-secondary-medium border-b">
                        <td class="px-6 py-4 font-medium">{{ $course->courseYear }}</td>
                        <td class="px-6 py-4">{{ $course->courseID }}</td>
                        <td class="px-6 py-4">{{ $course->courseName }}</td>
                        <td class="px-6 py-4">{{ $course->courseCredit }}</td>
                        <td class="px-6 py-4">{{ $course->courseType }}</td>
                        <td class="px-6 py-4">{{ $course->courseDescript ?? '—' }}</td>
                        <td class="px-6 py-4">{{ $course->courseSemester }}</td>
                        <td class="px-6 py-4">{{ $course->courseDegree }}</td>

                        {{-- Edit/Delete only for admin --}}
                        @if (auth()->user()->isAdmin())
                            <td class="px-6 py-4 gap-3 flex">
                                <a href="{{ route('course.edit', $course->courseID) }}" class="text-blue-600 hover:underline">Edit</a>

                                <form action="{{ route('course.destroy', $course->courseID) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        style="color: red"
                                        onclick="return confirm('Delete course {{ $course->courseID }}?');"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    {{-- Show this when no courses exist --}}
                    <tr>
                        <td colspan="8" class="py-8 text-gray-400 text-center">
                            No courses found.
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('course.create') }}" class="text-blue-500 underline">Add one?</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
