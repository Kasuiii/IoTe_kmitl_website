@extends('layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endpush

@section('content')
    @auth
        <div style="display: flex; align-items: center; gap: 12px">
            <!-- Show user avatar from Google -->
            @if (Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" width="36" height="36" style="border-radius: 50%" alt="Profile" />
            @endif

            <!-- Show user name -->
            <span>{{ Auth::user()->name }}</span>
            <span style="color: #888">({{ Auth::user()->role }})</span>

            <!-- Logout button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    style="background: #ef4444; color: white; padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer"
                >
                    Logout
                </button>
            </form>
        </div>
    @endauth

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
