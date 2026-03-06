@extends('layouts.app')
@section('title', 'Course List')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('content')
    @if (session('success'))
        <div style="color: green; text-align: center">{{ session('success') }}</div>
    @endif

    <div class="relative overflow-x-auto rounded-base border border-default bg-neutral-primary-soft px-5 py-5 shadow-xs">
        <table class="w-full text-left text-sm text-body rtl:text-right">
            <thead class="border-b border-default-medium bg-neutral-secondary-medium text-sm text-body">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input
                                id="table-checkbox-27"
                                type="checkbox"
                                x
                                value=""
                                class="h-4 w-4 rounded-xs border border-default-medium bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft"
                            />
                            <label for="table-checkbox-27" class="sr-only">Table checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">Year</th>
                    <th scope="col" class="px-6 py-3">IDr</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Credits</th>
                    <th scope="col" class="px-6 py-3">Type</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="border-b border-default bg-neutral-primary-soft hover:bg-neutral-secondary-medium">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input
                                    id="table-checkbox-28"
                                    type="checkbox"
                                    value=""
                                    class="h-4 w-4 rounded-xs border border-default-medium bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft"
                                />
                                <label for="table-checkbox-28" class="sr-only">Table checkbox</label>
                            </div>
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-heading">{{ $course->courseYear }}</td>
                        <td class="px-6 py-4">{{ $course->courseID }}</td>
                        <td class="px-6 py-4">{{ $course->courseName }}</td>
                        <td class="px-6 py-4">{{ $course->courseCredit }}</td>
                        <td class="px-6 py-4">{{ $course->courseType }}</td>
                        <td class="px-6 py-4">{{ $course->courseDescript }}</td>
                        <td class="px-6 py-4">{{ $course->courseSemester }}</td>
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

                {{--
                    <tr class="border-b border-default bg-neutral-primary-soft hover:bg-neutral-secondary-medium">
                    <td class="w-4 p-4">
                    <div class="flex items-center">
                    <input
                    id="table-checkbox-28"
                    type="checkbox"
                    value=""
                    class="h-4 w-4 rounded-xs border border-default-medium bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft"
                    />
                    <label for="table-checkbox-28" class="sr-only">Table checkbox</label>
                    </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-heading">Apple MacBook Pro 17"</th>
                    <td class="px-6 py-4">Silver</td>
                    <td class="px-6 py-4">Laptop</td>
                    <td class="px-6 py-4">$2999</td>
                    <td class="px-6 py-4">
                    <a href="#" class="font-medium text-fg-brand hover:underline">Edit</a>
                    </td>
                    </tr>
                --}}
            </tbody>
        </table>
        <nav class="flex-column flex flex-wrap items-center justify-between p-4 md:flex-row" aria-label="Table navigation">
            <span class="mb-4 block w-full text-sm font-normal text-body md:mb-0 md:inline md:w-auto">
                Showing
                <span class="font-semibold text-heading">1-10</span>
                of
                <span class="font-semibold text-heading">1000</span>
            </span>
            <ul class="flex -space-x-px text-sm">
                <li>
                    <a
                        href="#"
                        class="box-border flex h-9 items-center justify-center rounded-s-base border border-default-medium bg-neutral-secondary-medium px-3 text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none"
                    >
                        Previous
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="box-border flex h-9 w-9 items-center justify-center border border-default-medium bg-neutral-secondary-medium text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none"
                    >
                        1
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="box-border flex h-9 w-9 items-center justify-center border border-default-medium bg-neutral-secondary-medium text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none"
                    >
                        2
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        aria-current="page"
                        class="box-border flex h-9 w-9 items-center justify-center border border-default-medium bg-brand-softer text-sm font-medium text-fg-brand hover:bg-brand-soft hover:text-fg-brand focus:outline-none"
                    >
                        3
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="box-border flex h-9 w-9 items-center justify-center border border-default-medium bg-neutral-secondary-medium text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none"
                    >
                        ...
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="box-border flex h-9 w-9 items-center justify-center border border-default-medium bg-neutral-secondary-medium text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none"
                    >
                        5
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="box-border flex h-9 items-center justify-center rounded-e-base border border-default-medium bg-neutral-secondary-medium px-3 text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none"
                    >
                        Next
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection

@push('scripts')
    {{-- pagination --}}
    <script></script>
@endpush
