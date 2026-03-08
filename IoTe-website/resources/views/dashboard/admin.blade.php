@extends('layouts.app')
@section('title', 'Admin Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('content')
    <div class="p-4 gap-4 flex flex-col items-center justify-center">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 16px">
            ยินดีต้อนรับเข้าหน้าการจัดการข้อมูลคุณ {{ Auth::user()->name }}
        </h1>
        <p style="font-size: 16px; color: #555">ใช้เมนูนำทางเพื่อจัดการรายวิชา ผู้ใช้งาน และอื่นๆ</p>
        <div class="gap-4 flex flex-row flex-wrap items-center justify-between">
            <a
                href="{{ route('course.index') }}"
                class="gap-2 bg-white px-4 py-2 rounded-lg font-medium text-gray-800 border-gray-300 hover:bg-gray-100 text-decoration-none inline-flex items-center border transition-colors"
            >
                ไปยังหน้ารายวิชา
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="bg-white px-4 py-2 rounded-lg font-medium text-gray-800 border-gray-300 hover:bg-gray-100 text-decoration-none inline-flex items-center border transition-colors"
                >
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection
