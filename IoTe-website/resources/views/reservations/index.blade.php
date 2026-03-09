@extends('layouts.app')
@section('title', 'Equipment Reservation')

@section('content')
    {{-- Hero --}}
    <section class="contact-hero">
        <div class="max-w-7xl px-6 mx-auto">
            <p
                style="
                    color: rgba(255, 255, 255, 0.55);
                    font-size: 0.85rem;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.12em;
                    margin-bottom: 0.75rem;
                "
            >
                Laboratory Services
            </p>
            <h1 style="color: white; font-size: 2.8rem; font-weight: 800; line-height: 1.15; margin: 0">Equipment Reservation</h1>
            <p style="color: rgba(255, 255, 255, 0.7); margin-top: 0.85rem; font-size: 1rem; max-width: 520px">
                Browse and reserve laboratory equipment for your courses and research projects.
            </p>

            <div style="display: flex; gap: 1rem; margin-top: 1.75rem; flex-wrap: wrap">
                <a
                    href="{{ route('reservations.history') }}"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 0.45rem;
                        background: rgba(255, 255, 255, 0.15);
                        backdrop-filter: blur(4px);
                        color: white;
                        padding: 0.6rem 1.25rem;
                        border-radius: 0.5rem;
                        font-size: 0.88rem;
                        font-weight: 600;
                        text-decoration: none;
                        border: 1px solid rgba(255, 255, 255, 0.25);
                    "
                    onmouseover="this.style.background = 'rgba(255,255,255,0.25)'"
                    onmouseout="this.style.background = 'rgba(255,255,255,0.15)'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                        />
                    </svg>
                    My Reservations
                </a>

                @if ($myActiveReservations->isNotEmpty())
                    <span
                        style="
                            display: inline-flex;
                            align-items: center;
                            gap: 0.45rem;
                            background: rgba(251, 191, 36, 0.2);
                            border: 1px solid rgba(251, 191, 36, 0.4);
                            color: #fef3c7;
                            padding: 0.6rem 1.25rem;
                            border-radius: 0.5rem;
                            font-size: 0.88rem;
                            font-weight: 600;
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="15"
                            height="15"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        {{ $myActiveReservations->count() }} active request(s)
                    </span>
                @endif
            </div>
        </div>
    </section>

    {{-- Flash messages --}}
    @if (session('success'))
        <div style="background: #f0fdf4; border-left: 4px solid #16a34a; padding: 1rem 0; color: #166534; font-size: 0.9rem">
            <div class="max-w-7xl px-6 mx-auto">{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div style="background: #fef2f2; border-left: 4px solid #dc2626; padding: 1rem 0; color: #991b1b; font-size: 0.9rem">
            <div class="max-w-7xl px-6 mx-auto">{{ session('error') }}</div>
        </div>
    @endif

    {{-- Main content --}}
    <section style="padding: 4rem 0 5rem; background: var(--light)">
        <div class="max-w-7xl px-6 mx-auto">
            @forelse ($byCategory as $category => $items)
                {{-- Category header --}}
                <div
                    style="
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        margin-bottom: 1.75rem;
                        margin-top: {{ $loop->first ? '0' : '3.5rem' }};
                    "
                >
                    <h2 class="section-title" style="margin: 0; white-space: nowrap">{{ $category }}</h2>
                    <div style="flex: 1; height: 1px; background: #e2e8f0"></div>
                    <span style="font-size: 0.78rem; color: #94a3b8; font-weight: 600; white-space: nowrap">
                        {{ $items->count() }} item(s)
                    </span>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem">
                    @foreach ($items as $item)
                        @php
                            $available = $item->real_available > 0;
                        @endphp

                        <div
                            class="info-card"
                            style="
                                display: flex;
                                flex-direction: column;
                                overflow: hidden;
                                transition:
                                    transform 0.2s,
                                    box-shadow 0.2s;
                                position: relative;
                            "
                            onmouseover="
                                this.style.transform = 'translateY(-3px)';
                                this.style.boxShadow = '0 12px 32px rgba(0,0,0,0.12)';
                            "
                            onmouseout="
                                this.style.transform = '';
                                this.style.boxShadow = '';
                            "
                        >
                            {{-- Faculty badge --}}
                            @if ($item->faculty_access !== 'all')
                                <div
                                    style="
                                        position: absolute;
                                        top: 0.75rem;
                                        right: 0.75rem;
                                        z-index: 1;
                                        background: rgba(0, 0, 0, 0.55);
                                        backdrop-filter: blur(4px);
                                        color: white;
                                        font-size: 0.7rem;
                                        font-weight: 700;
                                        padding: 0.2rem 0.6rem;
                                        border-radius: 999px;
                                        text-transform: uppercase;
                                        letter-spacing: 0.05em;
                                    "
                                >
                                    {{ $item->faculty_access === 'engineering' ? 'Engineering' : 'Science' }}
                                </div>
                            @endif

                            {{-- Image --}}

                            @if ($item->image_url)
                                <div style="overflow: hidden; height: 180px">
                                    <img
                                        src="{{ $item->image_url }}"
                                        alt="{{ $item->name }}"
                                        style="width:100%; height:180px; object-fit:cover; transition:transform 0.4s;
                                            {{ ! $available ? 'filter:grayscale(55%)' : '' }}"
                                        onmouseover="this.style.transform = 'scale(1.05)'"
                                        onmouseout="this.style.transform = 'scale(1)'"
                                    />
                                </div>
                            @else
                                <div
                                    style="
                                        height: 150px;
                                        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        color: #cbd5e1;
                                    "
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="44"
                                        height="44"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                        />
                                    </svg>
                                </div>
                            @endif

                            {{-- Content --}}
                            <div style="padding: 1.25rem 1.25rem 1.5rem; flex: 1; display: flex; flex-direction: column">
                                <div
                                    style="
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: flex-start;
                                        gap: 0.5rem;
                                        margin-bottom: 0.5rem;
                                    "
                                >
                                    <h3 style="font-weight: 700; font-size: 1rem; color: #1e293b; line-height: 1.3; margin: 0">
                                        {{ $item->name }}
                                    </h3>

                                    @if ($available)
                                        <span
                                            style="
                                                flex-shrink: 0;
                                                font-size: 0.72rem;
                                                background: #dcfce7;
                                                color: #15803d;
                                                padding: 0.2rem 0.6rem;
                                                border-radius: 999px;
                                                font-weight: 700;
                                            "
                                        >
                                            {{ $item->real_available }} left
                                        </span>
                                    @else
                                        <span
                                            style="
                                                flex-shrink: 0;
                                                font-size: 0.72rem;
                                                background: #fee2e2;
                                                color: #b91c1c;
                                                padding: 0.2rem 0.6rem;
                                                border-radius: 999px;
                                                font-weight: 700;
                                            "
                                        >
                                            Taken
                                        </span>
                                    @endif
                                </div>

                                @if ($item->description)
                                    <p style="font-size: 0.83rem; color: #64748b; line-height: 1.55; margin: 0 0 0.85rem; flex: 1">
                                        {{ Str::limit($item->description, 90) }}
                                    </p>
                                @else
                                    <div style="flex: 1"></div>
                                @endif

                                {{-- Meta --}}
                                <div
                                    style="
                                        display: flex;
                                        align-items: center;
                                        justify-content: space-between;
                                        padding: 0.65rem 0;
                                        border-top: 1px solid #f1f5f9;
                                        margin-bottom: 1rem;
                                    "
                                >
                                    <span style="font-size: 0.78rem; color: #94a3b8; display: flex; align-items: center; gap: 0.3rem">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="13"
                                            height="13"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                        Max {{ $item->max_borrow_days }} days
                                    </span>
                                    <span style="font-size: 0.78rem; color: #94a3b8; display: flex; align-items: center; gap: 0.3rem">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="13"
                                            height="13"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                            />
                                        </svg>
                                        {{ $item->quantity_total }} total
                                    </span>
                                </div>

                                {{-- CTA --}}

                                @if ($available)
                                    <a
                                        href="{{ route('reservations.create', $item) }}"
                                        style="
                                            display: block;
                                            text-align: center;
                                            background: var(--crimson);
                                            color: white;
                                            padding: 0.65rem;
                                            border-radius: 0.5rem;
                                            font-weight: 700;
                                            font-size: 0.875rem;
                                            text-decoration: none;
                                        "
                                        onmouseover="this.style.opacity = '0.88'"
                                        onmouseout="this.style.opacity = '1'"
                                    >
                                        Reserve Now
                                    </a>
                                @else
                                    <div
                                        style="
                                            display: block;
                                            text-align: center;
                                            background: #f1f5f9;
                                            color: #94a3b8;
                                            padding: 0.65rem;
                                            border-radius: 0.5rem;
                                            font-weight: 700;
                                            font-size: 0.875rem;
                                            cursor: not-allowed;
                                        "
                                    >
                                        Currently Unavailable
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div style="text-align: center; padding: 6rem 2rem">
                    <div
                        style="
                            width: 72px;
                            height: 72px;
                            background: #f1f5f9;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin: 0 auto 1.25rem;
                            color: #94a3b8;
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                            />
                        </svg>
                    </div>
                    <p style="font-size: 1.1rem; font-weight: 600; color: #374151; margin: 0 0 0.4rem">No equipment available</p>
                    <p style="font-size: 0.9rem; color: #94a3b8">No items are currently listed for your faculty.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
