@extends('layouts.app')
@section('title', 'My Reservations')

@section('content')
    <section class="contact-hero">
        <div class="max-w-6xl px-6 mx-auto">
            <h1 style="color: white; font-size: 2.4rem; font-weight: 800">My Reservations</h1>
            <p style="color: rgba(255, 255, 255, 0.7); margin-top: 0.5rem">Track all your equipment borrow requests.</p>
        </div>
    </section>

    <section style="padding: 3.5rem 0; background: var(--light)">
        <div class="max-w-6xl px-6 mx-auto">
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

            @if (session('error'))
                <div
                    style="
                        background: #fef2f2;
                        border-left: 4px solid #dc2626;
                        padding: 0.9rem 1.25rem;
                        color: #991b1b;
                        border-radius: 0.5rem;
                        margin-bottom: 1.5rem;
                        font-size: 0.9rem;
                    "
                >
                    {{ session('error') }}
                </div>
            @endif

            {{-- Header row --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem">
                <h2 style="font-size: 1.2rem; font-weight: 700; color: #1e293b">All Requests</h2>
                <a
                    href="{{ route('reservations.index') }}"
                    style="
                        background: var(--crimson);
                        color: white;
                        padding: 0.5rem 1.25rem;
                        border-radius: 0.5rem;
                        font-size: 0.875rem;
                        font-weight: 600;
                        text-decoration: none;
                    "
                >
                    + New Reservation
                </a>
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
                                    font-size: 0.8rem;
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
                                    font-size: 0.8rem;
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
                                    font-size: 0.8rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Borrow
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.8rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            >
                                Return
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.8rem;
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
                                    font-size: 0.8rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.05em;
                                "
                            ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $r)
                            <tr style="border-bottom:1px solid #f1f5f9; @if($r->is_overdue) background:#fff7ed; @endif">
                                <td style="padding: 0.9rem 1rem">
                                    <span style="font-weight: 600; color: #1e293b">{{ $r->item->name }}</span>
                                    @if ($r->is_overdue)
                                        <span style="font-size: 0.75rem; color: #dc2626; font-weight: 700; margin-left: 0.4rem">
                                            ⚠ OVERDUE
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 0.9rem 1rem; color: #475569">{{ $r->quantity_requested }}</td>
                                <td style="padding: 0.9rem 1rem; color: #475569; font-size: 0.875rem">
                                    {{ $r->borrow_date->format('d M Y') }}
                                </td>
                                <td style="padding: 0.9rem 1rem; color: #475569; font-size: 0.875rem">
                                    {{ $r->return_date->format('d M Y') }}
                                </td>
                                <td style="padding: 0.9rem 1rem">
                                    @php
                                        $color = \App\Models\Reservation::$statusLabels[$r->status]['color'] ?? '#6b7280';
                                    @endphp

                                    <span
                                        style="
                                            font-size: 0.78rem;
                                            font-weight: 700;
                                            padding: 0.25rem 0.7rem;
                                            border-radius: 999px;
                                            background: {{ $color }}20;
                                            color: {{ $color }};
                                        "
                                    >
                                        {{ $r->status_label }}
                                    </span>
                                </td>
                                <td style="padding: 0.9rem 1rem">
                                    @if ($r->status === 'pending')
                                        <form method="POST" action="{{ route('reservations.cancel', $r->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                type="submit"
                                                style="
                                                    font-size: 0.82rem;
                                                    color: #dc2626;
                                                    font-weight: 600;
                                                    background: none;
                                                    border: none;
                                                    cursor: pointer;
                                                    padding: 0;
                                                "
                                                onclick="return confirm('Cancel this reservation?');"
                                            >
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 3rem; text-align: center; color: #94a3b8; font-size: 0.95rem">
                                    You have no reservations yet.
                                    <a href="{{ route('reservations.index') }}" style="color: var(--crimson); font-weight: 600">
                                        Browse equipment →
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($reservations->hasPages())
                <div style="margin-top: 1.5rem">
                    {{ $reservations->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
