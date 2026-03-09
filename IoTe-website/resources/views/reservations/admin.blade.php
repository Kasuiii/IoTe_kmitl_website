@extends('layouts.app')
@section('title', 'Admin — Reservations')

{{-- Always available from the model, no need to pass from controller --}}
@php
    $statusLabels = \App\Models\Reservation::$statusLabels;
@endphp

@section('content')
    <section class="contact-hero">
        <div class="max-w-7xl px-6 gap-4 py-5 mx-auto flex flex-wrap items-center justify-start">
            <div class="min-w-[280px] flex-1">
                <h1 style="color: var(--crimson); font-size: 2.4rem; font-weight: 800">Reservation Management</h1>
                <p style="color: var(--crimson); margin-top: 0.5rem">Review and update equipment borrow requests.</p>
            </div>
            <a
                href="{{ route('admin.items.create') }}"
                style="
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    background: white;
                    color: var(--crimson);
                    padding: 0.7rem 1.5rem;
                    border-radius: 0.5rem;
                    font-weight: 700;
                    font-size: 0.9rem;
                    text-decoration: none;
                    white-space: nowrap;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                "
                onmouseover="this.style.background = '#f8fafc'"
                onmouseout="this.style.background = 'white'"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Add Equipment
            </a>
        </div>
    </section>

    <section style="padding: 3rem 0; background: var(--light)">
        <div class="max-w-7xl px-6 mx-auto">
            {{-- Flash --}}
            @if (session('success'))
                <div
                    style="
                        background: #f0fdf4;
                        border-left: 4px solid #16a34a;
                        padding: 0.9rem 1.25rem;
                        color: #166534;
                        border-radius: 0.5rem;
                        margin-bottom: 1.5rem;
                        font-size: 0.9rem;
                    "
                >
                    {{ session('success') }}
                </div>
            @endif

            {{-- Status filter --}}
            <div
                style="
                    background: white;
                    border-radius: 0.75rem;
                    padding: 1.25rem 1.5rem;
                    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06);
                    margin-bottom: 1.5rem;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    gap: 0.6rem;
                "
            >
                <span style="font-size: 0.85rem; font-weight: 600; color: #475569; margin-right: 0.5rem">Filter:</span>

                <a
                    href="{{ route('reservations.admin') }}"
                    style="font-size:0.82rem; padding:0.3rem 0.85rem; border-radius:999px; text-decoration:none; font-weight:600;
                      {{ ! request('status') ? 'background:var(--crimson); color:white' : 'background:#f1f5f9; color:#475569' }}"
                >
                    All
                </a>

                @foreach ($statusOptions as $s)
                    @php
                        $meta = $statusLabels[$s];
                    @endphp

                    <a
                        href="{{ route('reservations.admin', ['status' => $s]) }}"
                        style="font-size:0.82rem; padding:0.3rem 0.85rem; border-radius:999px; text-decoration:none; font-weight:600;
                          {{ request('status') === $s ? 'background:' . $meta['color'] . '; color:white' : 'background:#f1f5f9; color:#475569' }}"
                    >
                        {{ $meta['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Table --}}
            <div style="background: white; border-radius: 1rem; box-shadow: 0 1px 8px rgba(0, 0, 0, 0.07); overflow: hidden">
                <table class="w-full" style="border-collapse: collapse">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0">
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.78rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                ID
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.78rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Student
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.78rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Item
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.78rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Qty
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.78rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Dates
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.78rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Status
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.78rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            @php
                                $meta = $statusLabels[$reservation->status] ?? ['label' => $reservation->status, 'color' => '#6b7280'];
                            @endphp

                            <tr style="border-bottom: 1px solid #f1f5f9; vertical-align: top">
                                <td style="padding: 1rem; font-size: 0.85rem; color: #94a3b8">#{{ $reservation->id }}</td>

                                {{--
                                    BUG FIX: was $reservation->student_name (doesn't exist).
                                    Now uses the loaded 'user' relationship.
                                --}}
                                <td style="padding: 1rem">
                                    <div style="font-weight: 600; font-size: 0.9rem; color: #1e293b">
                                        {{ $reservation->user->name }}
                                    </div>
                                    <div style="font-size: 0.78rem; color: #94a3b8">
                                        {{ $reservation->user->email }}
                                    </div>
                                </td>

                                <td style="padding: 1rem; font-size: 0.875rem; color: #374151; font-weight: 500">
                                    {{ $reservation->item->name }}
                                </td>

                                <td style="padding: 1rem; font-size: 0.875rem; color: #475569; text-align: center">
                                    {{ $reservation->quantity_requested }}
                                </td>

                                <td style="padding: 1rem; font-size: 0.8rem; color: #475569">
                                    <div>{{ $reservation->borrow_date->format('d M Y') }}</div>
                                    <div style="color: #94a3b8">→ {{ $reservation->return_date->format('d M Y') }}</div>
                                </td>

                                <td style="padding: 1rem">
                                    <span
                                        style="
                                            font-size: 0.78rem;
                                            font-weight: 700;
                                            padding: 0.3rem 0.7rem;
                                            border-radius: 999px;
                                            background: {{ $meta['color'] }}20;
                                            color: {{ $meta['color'] }};
                                        "
                                    >
                                        {{ $meta['label'] }}
                                    </span>
                                    @if ($reservation->is_overdue)
                                        <div style="font-size: 0.72rem; color: #dc2626; font-weight: 700; margin-top: 0.25rem">
                                            ⚠ OVERDUE
                                        </div>
                                    @endif
                                </td>

                                {{-- Status update inline form --}}
                                <td style="padding: 1rem; min-width: 220px">
                                    <form
                                        method="POST"
                                        action="{{ route('reservations_admin.updateStatus', $reservation) }}"
                                        style="display: flex; flex-direction: column; gap: 0.4rem"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="status"
                                            style="
                                                font-size: 0.82rem;
                                                border: 1px solid #e2e8f0;
                                                border-radius: 0.4rem;
                                                padding: 0.35rem 0.5rem;
                                                color: #374151;
                                            "
                                        >
                                            @foreach ($statusOptions as $s)
                                                <option value="{{ $s }}" {{ $reservation->status === $s ? 'selected' : '' }}>
                                                    {{ $statusLabels[$s]['label'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <input
                                            type="text"
                                            name="admin_notes"
                                            placeholder="Notes (optional)"
                                            value="{{ $reservation->admin_notes }}"
                                            style="
                                                font-size: 0.8rem;
                                                border: 1px solid #e2e8f0;
                                                border-radius: 0.4rem;
                                                padding: 0.35rem 0.5rem;
                                                color: #374151;
                                            "
                                        />

                                        <button
                                            type="submit"
                                            style="
                                                font-size: 0.8rem;
                                                background: var(--crimson);
                                                color: white;
                                                border: none;
                                                border-radius: 0.4rem;
                                                padding: 0.35rem 0.75rem;
                                                cursor: pointer;
                                                font-weight: 600;
                                                text-align: center;
                                            "
                                        >
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 3rem; text-align: center; color: #94a3b8; font-size: 0.95rem">
                                    No reservations found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($reservations->hasPages())
                <div style="margin-top: 1.5rem">
                    {{ $reservations->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
