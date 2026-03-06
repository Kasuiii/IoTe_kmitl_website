{{--
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Add Course</title>
    </head>
    <body>
    
    @if(session('success'))
    <div style="color: green; text-align: center;">
    {{ session('success') }}
    </div>
    @endif
    
    @if ($errors->any())
    <div style="color: red; text-align: center;">
    <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif
    
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
    <form id="form1" name="form1" method="post" action="/add_course">
    @csrf
    
    <td>
    <table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
    <td width="117">Course Year</td>
    <td width="14">:</td>
    <td width="357"><input name="courseYear" type="text" id="courseYear" size="40" /></td>
    </tr>
    <tr>
    <td>Course ID</td>
    <td>:</td>
    <td><input name="courseID" type="text" id="courseID" size="40" /></td>
    </tr>
    <tr>
    <td valign="top">Course Name</td>
    <td valign="top">:</td>
    <td><textarea name="courseName" cols="40" rows="3" id="courseName"></textarea></td>
    </tr>
    <tr>
    <td>Course credit</td>
    <td>:</td>
    <td><input name="courseCredit" type="text" id="courseCredit" size="40" /></td>
    </tr>
    <tr>
    <td>Course description</td>
    <td>:</td>
    <td><input name="courseDescript" type="text" id="courseDescript" size="40" /></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <input type="submit" name="Submit" value="Submit" />
    <input type="reset" name="Submit2" value="Reset" />
    </td>
    </tr>
    </table>
    </td>
    </form>
    </tr>
    </table>
    <div>
    @isset($variable)
    @foreach($courses as $course)
    <tr>
    <td align="center">{{ $course->courseYear }}</td>
    <td align="center">{{ $course->courseID }}</td>
    <td>{{ $course->courseName }}</td>
    <td align="center">{{ $course->courseCredit }}</td>
    <td>{{ $course->courseDescript }}</td>
    
    <td align="center">
    <a href="/courses/{{ $course->courseID }}/edit">Edit</a>
    
    <form action="/courses/{{ $course->courseID }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this course?');">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;">Delete</button>
    </form>
    </td>
    </tr>
    @endforeach
    @else
    <p>No value found.</p>
    @endisset
    </div>
    <div>
    @if ($errors->any())
    <div style="color: red; text-align: center;">
    <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif
    @if (isset($course))
    <h2 style="text-align: center;">Edit Course: {{ $course->courseID }}</h2>
    @else
    <p style="text-align: center;">Course not found.</p>
    @endif
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
    <form method="POST" action="/courses/{{ $course->courseID }}">
    @csrf
    @method('PUT') <td>
    <table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
    <td width="117">Course Year</td>
    <td width="14">:</td>
    <td width="357"><input name="courseYear" type="text" value="{{ $course->courseYear }}" size="40" /></td>
    </tr>
    <tr>
    <td>Course ID</td>
    <td>:</td>
    <td><input type="text" value="{{ $course->courseID }}" size="40" disabled /></td>
    </tr>
    <tr>
    <td valign="top">Course Name</td>
    <td valign="top">:</td>
    <td><textarea name="courseName" cols="40" rows="3">{{ $course->courseName }}</textarea></td>
    </tr>
    <tr>
    <td>Course credit</td>
    <td>:</td>
    <td><input name="courseCredit" type="text" value="{{ $course->courseCredit }}" size="40" /></td>
    </tr>
    <tr>
    <td>Course description</td>
    <td>:</td>
    <td><input name="courseDescript" type="text" value="{{ $course->courseDescript }}" size="40" /></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <input type="submit" value="Update Course" />
    <a href="/courses">Cancel</a>
    </td>
    </tr>
    </table>
    </td>
    </form>
    </tr>
    </table>
    </div>
    </body>
    </html>
--}}
@extends('layouts.app')
@section('title', 'Contact Us')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="mb-6 text-3xl font-bold">Contact Us</h1>
        <p class="mb-4">If you have any questions or inquiries, please feel free to reach out to us using the form below:</p>
        <form action="/contact" method="POST" class="max-w-lg">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                />
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                />
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="4"
                    required
                    class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                ></textarea>
            </div>
            <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Send Message</button>
        </form>
    </div>
@endsection
