{{--
    ═══════════════════════════════════════════════════════════
    FILE: resources/views/admin/users/index.blade.php
    View all registered users + breakdown by year/faculty
    ════════════════════════════════════════════════════════════
--}}
@extends('layouts.app')
@section('title', 'Admin · User Accounts')

@push('styles')
    <style>
        .stat-mini {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            text-align: center;
        }
        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 900;
            color: var(--crimson);
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table th {
            background: var(--dark);
            color: #fff;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .admin-table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
            vertical-align: middle;
        }
        .admin-table tr:hover td {
            background: rgba(114, 10, 0, 0.02);
        }
        .badge {
            display: inline-block;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
        }
        .badge-admin {
            background: rgba(114, 10, 0, 0.12);
            color: var(--crimson);
        }
        .badge-user {
            background: rgba(107, 99, 96, 0.12);
            color: var(--muted);
        }
        .badge-eng {
            background: rgba(59, 130, 246, 0.12);
            color: #2563eb;
        }
        .badge-sci {
            background: rgba(16, 185, 129, 0.12);
            color: #059669;
        }
        .badge-yr {
            background: rgba(245, 158, 11, 0.12);
            color: #d97706;
        }
    </style>
@endpush

@section('content')
    <section style="background: var(--dark); padding: 3.5rem 0 2.5rem; position: relative; overflow: hidden">
        <div
            style="position: absolute; inset: 0; background: radial-gradient(ellipse at 70% 50%, rgba(114, 10, 0, 0.4), transparent 65%)"
        ></div>
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Admin Panel</span>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 900; color: #fff">User Accounts</h1>
            <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.9rem">ดูบัญชีผู้ใช้ทั้งหมดและข้อมูลนักศึกษา</p>
        </div>
    </section>

    <section style="padding: 3rem 0; background: var(--light); min-height: 60vh">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            @if (session('success'))
                <div
                    style="
                        background: #f0fdf4;
                        border: 1px solid #bbf7d0;
                        color: #16a34a;
                        padding: 0.875rem 1.25rem;
                        border-radius: 10px;
                        margin-bottom: 1.5rem;
                        font-size: 0.875rem;
                    "
                >
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Stats cards --}}
            <div class="md:grid-cols-5 gap-4 mb-8 grid grid-cols-2">
                <div class="stat-mini">
                    <div class="stat-num">{{ $stats['total'] }}</div>
                    <div style="color: var(--muted); font-size: 0.78rem; margin-top: 0.25rem">ผู้ใช้ทั้งหมด</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-num" style="color: var(--crimson)">{{ $stats['admins'] }}</div>
                    <div style="color: var(--muted); font-size: 0.78rem">Admin</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-num" style="color: #2563eb">{{ $stats['engineering'] }}</div>
                    <div style="color: var(--muted); font-size: 0.78rem">Engineering (01)</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-num" style="color: #059669">{{ $stats['science'] }}</div>
                    <div style="color: var(--muted); font-size: 0.78rem">Science (05)</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-num" style="color: var(--muted)">{{ $stats['other'] }}</div>
                    <div style="color: var(--muted); font-size: 0.78rem">Other / Staff</div>
                </div>
            </div>

            {{-- Year breakdown --}}
            @if ($byYear->count())
                <div style="background: #fff; border: 1px solid var(--border); border-radius: 14px; padding: 1.5rem; margin-bottom: 1.5rem">
                    <h3
                        style="
                            font-family: 'Playfair Display', serif;
                            font-size: 1rem;
                            font-weight: 900;
                            color: var(--dark);
                            margin-bottom: 1rem;
                        "
                    >
                        นักศึกษาแบ่งตามชั้นปี
                    </h3>
                    <div class="gap-3 flex flex-wrap">
                        @foreach ($byYear as $yearLabel => $students)
                            <div
                                style="
                                    background: rgba(245, 158, 11, 0.08);
                                    border: 1px solid rgba(245, 158, 11, 0.2);
                                    border-radius: 10px;
                                    padding: 0.6rem 1.2rem;
                                    text-align: center;
                                "
                            >
                                <div style="font-weight: 900; font-size: 1.2rem; color: #d97706; font-family: 'Playfair Display', serif">
                                    {{ $students->count() }}
                                </div>
                                <div style="font-size: 0.72rem; color: var(--muted)">{{ $yearLabel }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Users table --}}
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
                                <th>User</th>
                                <th>Email</th>
                                <th>Student #</th>
                                <th>Faculty</th>
                                <th>Year</th>
                                <th>Role</th>
                                <th style="width: 140px">Change Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr>
                                    <td>
                                        <div class="gap-2 flex items-center">
                                            @if ($u->avatar)
                                                <img
                                                    src="{{ $u->avatar }}"
                                                    style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid var(--border)"
                                                />
                                            @else
                                                <div
                                                    style="
                                                        width: 36px;
                                                        height: 36px;
                                                        border-radius: 50%;
                                                        background: var(--crimson);
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        color: #fff;
                                                        font-weight: 700;
                                                        font-size: 0.85rem;
                                                    "
                                                >
                                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <span class="font-semibold" style="color: var(--dark); font-size: 0.85rem">
                                                {{ $u->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td style="color: var(--muted)">{{ $u->email }}</td>
                                    <td>
                                        @if ($u->is_student)
                                            <span class="badge badge-yr">{{ $u->student_number }}</span>
                                        @else
                                            <span style="color: var(--muted)">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($u->faculty_code === '01')
                                            <span class="badge badge-eng">Engineering</span>
                                        @elseif ($u->faculty_code === '05')
                                            <span class="badge badge-sci">Science</span>
                                        @else
                                            <span style="color: var(--muted)">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($u->student_year)
                                            <span class="badge badge-yr">ปี {{ $u->student_year }}</span>
                                        @else
                                            <span style="color: var(--muted)">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $u->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                            {{ $u->role }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- Quick role toggle --}}
                                        <form method="POST" action="{{ route('admin.users.updateRole', $u) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="gap-1 flex items-center">
                                                <select
                                                    name="role"
                                                    class="text-xs rounded px-1 py-0.5 border"
                                                    style="border-color: var(--border); font-size: 0.75rem"
                                                >
                                                    <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>user</option>
                                                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>admin</option>
                                                </select>
                                                <button
                                                    type="submit"
                                                    style="
                                                        background: var(--crimson);
                                                        color: #fff;
                                                        border: none;
                                                        border-radius: 6px;
                                                        padding: 0.25rem 0.5rem;
                                                        font-size: 0.72rem;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
