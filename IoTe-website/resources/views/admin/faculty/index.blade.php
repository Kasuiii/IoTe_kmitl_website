@extends('layouts.app')
@section('title', 'Admin · Faculty Management')

@push('styles')
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table th {
            background: var(--dark);
            color: #fff;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .admin-table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            font-size: 0.875rem;
        }
        .admin-table tr:hover td {
            background: rgba(114, 10, 0, 0.03);
        }
        .role-badge {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
        }
        .role-professor {
            background: rgba(114, 10, 0, 0.12);
            color: var(--crimson);
        }
        .role-assoc_prof {
            background: rgba(227, 82, 5, 0.12);
            color: var(--orange);
        }
        .role-asst_prof {
            background: rgba(59, 130, 246, 0.12);
            color: #2563eb;
        }
        .role-lecturer {
            background: rgba(22, 163, 74, 0.12);
            color: #16a34a;
        }
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.375rem 0.75rem;
            border-radius: 7px;
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-edit {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }
        .btn-edit:hover {
            background: #2563eb;
            color: #fff;
        }
        .btn-delete {
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
        }
        .btn-delete:hover {
            background: #dc2626;
            color: #fff;
        }
        .flash-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 0.875rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
@endpush

@section('content')
    {{-- ═══ ADMIN HERO ═══ --}}
    <section style="background: var(--dark); padding: 3.5rem 0 2.5rem; position: relative; overflow: hidden">
        <div
            style="position: absolute; inset: 0; background: radial-gradient(ellipse at 70% 50%, rgba(114, 10, 0, 0.4), transparent 65%)"
        ></div>
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Admin Panel</span>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 900; color: #fff">Faculty Management</h1>
            <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.9rem; margin-top: 0.5rem">จัดการข้อมูลอาจารย์และบุคลากรของภาควิชา</p>
        </div>
    </section>

    {{-- ═══ CONTENT ═══ --}}
    <section style="padding: 3rem 0; background: var(--light); min-height: 60vh">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            {{-- Flash messages --}}
            @if (session('success'))
                <div class="flash-success">✅ {{ session('success') }}</div>
            @endif

            {{-- Top bar: title + Add button --}}
            <div class="mb-6 gap-4 flex flex-wrap items-center justify-between">
                <div>
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 900; color: var(--dark)">
                        ทั้งหมด {{ $members->count() }} คน
                    </h2>
                </div>
                <a href="{{ route('admin.faculty.create') }}" class="btn-primary gap-2 flex items-center" style="font-size: 0.875rem">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    เพิ่มอาจารย์
                </a>
            </div>

            {{-- Table --}}
            <div
                style="
                    background: #fff;
                    border-radius: 16px;
                    overflow: hidden;
                    border: 1px solid var(--border);
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                "
            >
                <div style="overflow-x: auto">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th style="width: 60px">#</th>
                                <th>Photo</th>
                                <th>ชื่อ / Name</th>
                                <th>ตำแหน่ง / Role</th>
                                <th>อีเมล</th>
                                <th>Research Interests</th>
                                <th style="width: 140px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $m)
                                <tr>
                                    <td style="color: var(--muted); font-size: 0.75rem">{{ $m->sort_order ?: $m->id }}</td>
                                    <td>
                                        @if ($m->photo_url)
                                            <img
                                                src="{{ $m->photo_url }}"
                                                alt="{{ $m->name_en }}"
                                                style="
                                                    width: 44px;
                                                    height: 44px;
                                                    border-radius: 50%;
                                                    object-fit: cover;
                                                    border: 2px solid var(--border);
                                                "
                                                onerror="
                                                    this.src =
                                                        'https://ui-avatars.com/api/?name={{ urlencode($m->name_en) }}&background=720A00&color=fff'
                                                "
                                            />
                                        @else
                                            <div
                                                style="
                                                    width: 44px;
                                                    height: 44px;
                                                    border-radius: 50%;
                                                    background: linear-gradient(135deg, var(--crimson), var(--orange));
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                    color: #fff;
                                                    font-weight: 700;
                                                    font-size: 1rem;
                                                    font-family: 'Playfair Display', serif;
                                                "
                                            >
                                                {{ strtoupper(substr($m->name_en, 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="font-semibold" style="color: var(--dark)">{{ $m->prefix }} {{ $m->name_en }}</div>
                                        <div style="color: var(--muted); font-size: 0.75rem">{{ $m->name_th }}</div>
                                        @if ($m->position)
                                            <div style="color: var(--crimson); font-size: 0.72rem; font-weight: 600; margin-top: 2px">
                                                {{ $m->position }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="role-badge role-{{ $m->role }}">{{ $m->role_label }}</span>
                                    </td>
                                    <td style="color: var(--muted)">{{ $m->email ?? '—' }}</td>
                                    <td>
                                        <div class="gap-1 flex flex-wrap">
                                            @foreach (array_slice($m->research_interests_array, 0, 3) as $ri)
                                                <span class="tag" style="font-size: 0.65rem">{{ $ri }}</span>
                                            @endforeach

                                            @if (count($m->research_interests_array) > 3)
                                                <span style="font-size: 0.7rem; color: var(--muted)">
                                                    +{{ count($m->research_interests_array) - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="gap-2 flex items-center">
                                            <a href="{{ route('admin.faculty.edit', $m) }}" class="action-btn btn-edit">✏️ Edit</a>
                                            <form
                                                method="POST"
                                                action="{{ route('admin.faculty.destroy', $m) }}"
                                                onsubmit="return confirm('ลบ {{ $m->name_en }} ใช่ไหม?');"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn btn-delete">🗑 Del</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center" style="color: var(--muted)">
                                        ยังไม่มีข้อมูลอาจารย์ — กดปุ่ม "เพิ่มอาจารย์" ด้านบน
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Back link --}}
            <div class="mt-6">
                <a href="{{ route('dashboard.admin') }}" style="color: var(--muted); font-size: 0.875rem; text-decoration: none">
                    ← กลับหน้า Admin Dashboard
                </a>
            </div>
        </div>
    </section>
@endsection
