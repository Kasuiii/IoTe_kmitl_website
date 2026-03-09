@extends('layouts.app')
@section('title', 'Reserve ' . $item->name)

@section('content')
    {{-- Hero --}}
    <section class="contact-hero">
        <div class="max-w-5xl px-6 mx-auto">
            <p
                style="
                    color: rgba(255, 255, 255, 0.65);
                    font-size: 0.9rem;
                    margin-bottom: 0.5rem;
                    text-transform: uppercase;
                    letter-spacing: 0.08em;
                "
            >
                Equipment Reservation
            </p>
            <h1 style="color: white; font-size: 2.4rem; font-weight: 800; line-height: 1.2">
                {{ $item->name }}
            </h1>
            <p style="color: rgba(255, 255, 255, 0.7); margin-top: 0.5rem">
                Category: {{ $item->category }} &nbsp;·&nbsp; Max borrow: {{ $item->max_borrow_days }} days
            </p>
        </div>
    </section>

    <section style="padding: 4rem 0; background: var(--light)">
        <div class="max-w-xl px-4 mx-auto">
            {{-- Availability notice --}}
            <div
                style="
                    background: #eff6ff;
                    border: 1px solid #bfdbfe;
                    border-radius: 0.75rem;
                    padding: 1rem 1.25rem;
                    margin-bottom: 1.75rem;
                    display: flex;
                    gap: 0.75rem;
                    align-items: flex-start;
                "
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="#3b82f6"
                    style="flex-shrink: 0; margin-top: 2px"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <div style="font-size: 0.9rem; color: #1e40af">
                    <strong>{{ $availableQty }}</strong>
                    unit(s) currently available. Your request will be reviewed by an admin before approval.
                </div>
            </div>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div
                    style="
                        background: #fef2f2;
                        border: 1px solid #fecaca;
                        border-radius: 0.75rem;
                        padding: 1rem 1.25rem;
                        margin-bottom: 1.5rem;
                    "
                >
                    <p style="font-weight: 600; color: #991b1b; margin-bottom: 0.4rem; font-size: 0.9rem">Please fix the following:</p>
                    <ul style="list-style: disc; padding-left: 1.2rem; font-size: 0.875rem; color: #b91c1c">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form card --}}
            <div class="bg-white p-8 rounded-2xl shadow">
                <form method="POST" action="{{ route('reservations.store', $item) }}">
                    @csrf

                    {{-- Quantity --}}
                    <div style="margin-bottom: 1.25rem">
                        <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.4rem; font-size: 0.9rem">
                            Quantity
                        </label>
                        <input
                            type="number"
                            name="quantity_requested"
                            min="1"
                            max="{{ $availableQty }}"
                            value="{{ old('quantity_requested', 1) }}"
                            class="rounded p-2 w-full border"
                            style="@error('quantity_requested') border-color:#dc2626; @enderror"
                        />
                        @error('quantity_requested')
                            <p style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Dates row --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem">
                        <div>
                            <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.4rem; font-size: 0.9rem">
                                Borrow Date
                            </label>
                            <input
                                type="date"
                                name="borrow_date"
                                value="{{ old('borrow_date') }}"
                                min="{{ date('Y-m-d') }}"
                                class="rounded p-2 w-full border"
                                style="@error('borrow_date') border-color:#dc2626; @enderror"
                            />
                            @error('borrow_date')
                                <p style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.4rem; font-size: 0.9rem">
                                Return Date
                            </label>
                            <input
                                type="date"
                                name="return_date"
                                value="{{ old('return_date') }}"
                                class="rounded p-2 w-full border"
                                style="@error('return_date') border-color:#dc2626; @enderror"
                            />
                            @error('return_date')
                                <p style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Purpose --}}
                    <div style="margin-bottom: 1.75rem">
                        <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.4rem; font-size: 0.9rem">
                            Purpose
                            <span style="color: #9ca3af; font-weight: 400">(max 500 chars)</span>
                        </label>
                        <textarea
                            name="purpose"
                            rows="4"
                            class="rounded p-2 w-full border"
                            style="@error('purpose') border-color:#dc2626; @enderror resize:vertical"
                            placeholder="Describe why you need this equipment..."
                        >
{{ old('purpose') }}</textarea
                        >
                        @error('purpose')
                            <p style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 0.75rem">
                        <button
                            type="submit"
                            class="px-6 py-2 rounded"
                            style="background: var(--crimson); color: white; font-weight: 600; font-size: 0.95rem; flex: 1"
                        >
                            Submit Reservation
                        </button>
                        <a
                            href="{{ route('reservations.index') }}"
                            class="px-6 py-2 rounded text-center"
                            style="background: #f1f5f9; color: #475569; font-weight: 600; font-size: 0.95rem; text-decoration: none"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
