@extends('layouts.app')
@section('title', 'Admin — Equipment')

@section('content')
    <section class="contact-hero">
        <div
            class="max-w-7xl px-6 mx-auto"
            style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem"
        >
            <div>
                <p
                    style="
                        color: rgba(255, 255, 255, 0.55);
                        font-size: 0.85rem;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 0.12em;
                        margin-bottom: 0.5rem;
                    "
                >
                    Admin Panel
                </p>
                <h1 style="color: var(--crimson); font-size: 2.4rem; font-weight: 800; margin: 0">Equipment Management</h1>
                <p style="color: var(--crimson); margin-top: 0.5rem; font-size: 0.95rem">
                    Add, edit, and manage all reservable laboratory items.
                </p>
            </div>
            <div class="p-4 gap-4 sm:flex-row flex flex-col justify-center">
                <a
                    href="{{ route('reservations.admin') }}"
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
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        height="24px"
                        viewBox="0 -960 960 960"
                        width="24px"
                        fill="#e3e3e3"
                        stork="currentColor"
                    >
                        <path d="m560-240-56-58 142-142H160v-80h486L504-662l56-58 240 240-240 240Z" />
                    </svg>
                    View All Equipment
                </a>
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
        </div>
    </section>

    <section style="padding: 3rem 0 5rem; background: var(--light)">
        <div class="max-w-7xl px-6 mx-auto">
            {{-- Flash --}}
            @if (session('success'))
                <div
                    style="
                        background: #f0fdf4;
                        border-left: 4px solid #16a34a;
                        padding: 1rem 1.25rem;
                        color: #166534;
                        border-radius: 0.5rem;
                        margin-bottom: 1.5rem;
                        font-size: 0.9rem;
                        display: flex;
                        align-items: center;
                        gap: 0.6rem;
                    "
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Stats bar --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 2rem">
                @php
                    $total = $items->count();
                    $active = $items->where('is_active', true)->count();
                    $inactive = $items->where('is_active', false)->count();
                    $totalBorrowed = $items->sum('active_count');
                @endphp

                @foreach ([
                        ['label' => 'Total Items', 'value' => $total, 'color' => '#3b82f6', 'bg' => '#eff6ff'],
                        ['label' => 'Active', 'value' => $active, 'color' => '#16a34a', 'bg' => '#f0fdf4'],
                        ['label' => 'Hidden', 'value' => $inactive, 'color' => '#9ca3af', 'bg' => '#f9fafb'],
                        ['label' => 'Currently Lent', 'value' => $totalBorrowed, 'color' => '#dc2626', 'bg' => '#fef2f2']
                    ]
                    as $stat)
                    <div
                        style="
                            background: {{ $stat['bg'] }};
                            border: 1px solid {{ $stat['color'] }}22;
                            border-radius: 0.75rem;
                            padding: 1rem 1.25rem;
                        "
                    >
                        <div style="font-size: 1.6rem; font-weight: 800; color: {{ $stat['color'] }}">{{ $stat['value'] }}</div>
                        <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; margin-top: 0.15rem">{{ $stat['label'] }}</div>
                    </div>
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
                                    font-size: 0.75rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.06em;
                                "
                            >
                                Item
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.75rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.06em;
                                "
                            >
                                Category
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: center;
                                    font-size: 0.75rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.06em;
                                "
                            >
                                Stock
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: center;
                                    font-size: 0.75rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.06em;
                                "
                            >
                                Lent
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.75rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.06em;
                                "
                            >
                                Access
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: left;
                                    font-size: 0.75rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.06em;
                                "
                            >
                                Status
                            </th>
                            <th
                                style="
                                    padding: 0.85rem 1rem;
                                    text-align: right;
                                    font-size: 0.75rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.06em;
                                "
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr
                                style="border-bottom:1px solid #f1f5f9; vertical-align:middle;
                                   {{ ! $item->is_active ? 'opacity:0.55' : '' }}"
                            >
                                {{-- Name + image --}}
                                <td style="padding: 1rem">
                                    <div style="display: flex; align-items: center; gap: 0.85rem">
                                        @if ($item->image_url)
                                            <img
                                                src="{{ $item->image_url }}"
                                                alt="{{ $item->name }}"
                                                style="width: 44px; height: 44px; object-fit: cover; border-radius: 0.4rem; flex-shrink: 0"
                                            />
                                        @else
                                            <div
                                                style="
                                                    width: 44px;
                                                    height: 44px;
                                                    background: #f1f5f9;
                                                    border-radius: 0.4rem;
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                    color: #cbd5e1;
                                                    flex-shrink: 0;
                                                "
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20"
                                                    height="20"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                                    />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div style="font-weight: 700; font-size: 0.9rem; color: #1e293b">{{ $item->name }}</div>
                                            <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.1rem">
                                                Max {{ $item->max_borrow_days }} days/loan
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td style="padding: 1rem; font-size: 0.875rem; color: #475569">{{ $item->category }}</td>

                                <td style="padding: 1rem; text-align: center">
                                    <span style="font-size: 0.85rem; font-weight: 700; color: #1e293b">{{ $item->quantity_total }}</span>
                                </td>

                                <td style="padding: 1rem; text-align: center">
                                    @if ($item->active_count > 0)
                                        <span
                                            style="
                                                font-size: 0.82rem;
                                                font-weight: 700;
                                                color: #dc2626;
                                                background: #fef2f2;
                                                padding: 0.2rem 0.6rem;
                                                border-radius: 999px;
                                            "
                                        >
                                            {{ $item->active_count }}
                                        </span>
                                    @else
                                        <span style="font-size: 0.82rem; color: #94a3b8">—</span>
                                    @endif
                                </td>

                                <td style="padding: 1rem">
                                    @php
                                        $accessColors = ['all' => ['#0ea5e9', '#e0f2fe'], 'engineering' => ['#7c3aed', '#f5f3ff'], 'science' => ['#16a34a', '#f0fdf4']];
                                        [$ac, $ab] = $accessColors[$item->faculty_access] ?? ['#6b7280', '#f9fafb'];
                                    @endphp

                                    <span
                                        style="
                                            font-size: 0.75rem;
                                            font-weight: 700;
                                            background: {{ $ab }};
                                            color: {{ $ac }};
                                            padding: 0.2rem 0.65rem;
                                            border-radius: 999px;
                                            text-transform: capitalize;
                                        "
                                    >
                                        {{ $item->faculty_access }}
                                    </span>
                                </td>

                                <td style="padding: 1rem">
                                    @if ($item->is_active)
                                        <span
                                            style="
                                                font-size: 0.75rem;
                                                font-weight: 700;
                                                background: #dcfce7;
                                                color: #15803d;
                                                padding: 0.2rem 0.65rem;
                                                border-radius: 999px;
                                            "
                                        >
                                            Active
                                        </span>
                                    @else
                                        <span
                                            style="
                                                font-size: 0.75rem;
                                                font-weight: 700;
                                                background: #f1f5f9;
                                                color: #64748b;
                                                padding: 0.2rem 0.65rem;
                                                border-radius: 999px;
                                            "
                                        >
                                            Hidden
                                        </span>
                                    @endif
                                </td>

                                <td style="padding: 1rem; text-align: right">
                                    <div style="display: inline-flex; gap: 0.5rem; align-items: center">
                                        <a
                                            href="{{ route('admin.items.edit', $item) }}"
                                            style="
                                                display: inline-flex;
                                                align-items: center;
                                                gap: 0.35rem;
                                                font-size: 0.8rem;
                                                font-weight: 600;
                                                color: #3b82f6;
                                                background: #eff6ff;
                                                padding: 0.35rem 0.85rem;
                                                border-radius: 0.4rem;
                                                text-decoration: none;
                                            "
                                            onmouseover="this.style.background = '#dbeafe'"
                                            onmouseout="this.style.background = '#eff6ff'"
                                        >
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
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                />
                                            </svg>
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.items.destroy', $item) }}"
                                            onsubmit="return confirm('Delete {{ addslashes($item->name) }}? This cannot be undone.');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                style="
                                                    display: inline-flex;
                                                    align-items: center;
                                                    gap: 0.35rem;
                                                    font-size: 0.8rem;
                                                    font-weight: 600;
                                                    color: #dc2626;
                                                    background: #fef2f2;
                                                    padding: 0.35rem 0.85rem;
                                                    border-radius: 0.4rem;
                                                    border: none;
                                                    cursor: pointer;
                                                "
                                                onmouseover="this.style.background = '#fee2e2'"
                                                onmouseout="this.style.background = '#fef2f2'"
                                            >
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
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 4rem; text-align: center; color: #94a3b8; font-size: 0.95rem">
                                    No equipment added yet.
                                    <a href="{{ route('admin.items.create') }}" style="color: var(--crimson); font-weight: 600">
                                        Add the first item →
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
