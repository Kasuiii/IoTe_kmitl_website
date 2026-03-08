@extends('layouts.app')
@section('title', 'Login')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('content')
    @if (session('error'))
        <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 16px">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="mt-5 gap-5 flex flex-col flex-wrap items-center justify-center text-center">
        <h1 class="text-3xl font-bold">Login Portal</h1>
        <a
            href="{{ route('google.login') }}"
            class="gap-2 bg-white px-5 py-2 rounded-lg font-medium text-gray-800 border-gray-300 hover:bg-gray-100 text-decoration-none inline-flex items-center border transition-colors"
        >
            <img src="https://www.google.com/favicon.ico" width="20" alt="Google" />
            Sign in with Google (
            @kmitl.ac.th
            only)
        </a>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg margin-bottom: 16px">✅ {{ session('success') }}</div>
        @endif
    </div>
@endsection
