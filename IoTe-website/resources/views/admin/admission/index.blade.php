{{--
    ═══════════════════════════════════════════════════════════
    FILE: resources/views/admin/admission/index.blade.php
    Shows all rounds and nested projects, with CRUD buttons
    ════════════════════════════════════════════════════════════
--}}
@extends('layouts.app')
@section('title', 'Admin · Admission Management')

@push('styles')
    <style>
        .round-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        }
        .round-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
            background: var(--dark);
        }
        .project-row {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .project-row:last-child {
            border-bottom: none;
        }
        .project-row:hover {
            background: rgba(114, 10, 0, 0.02);
        }
        .seat-badge {
            display: inline-block;
            background: rgba(114, 10, 0, 0.1);
            color: var(--crimson);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
        }
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.35rem 0.7rem;
            border-radius: 7px;
            font-size: 0.75rem;
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
        .btn-add-sm {
            background: rgba(22, 163, 74, 0.1);
            color: #16a34a;
        }
        .btn-add-sm:hover {
            background: #16a34a;
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
            <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 900; color: #fff">Admission Management</h1>
            <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.9rem">จัดการรอบการรับสมัครและโครงการรับสมัครนักศึกษา</p>
        </div>
    </section>

    <section style="padding: 3rem 0; background: var(--light); min-height: 60vh">
        <div class="max-w-5xl px-4 sm:px-6 lg:px-8 mx-auto">
            @if (session('success'))
                <div class="flash-success">✅ {{ session('success') }}</div>
            @endif

            {{-- Top bar --}}
            <div class="mb-6 gap-4 flex flex-wrap items-center justify-between">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 900; color: var(--dark)">
                    รอบการรับสมัคร ({{ $rounds->count() }} รอบ)
                </h2>
                <a href="{{ route('admin.admission.rounds.create') }}" class="btn-primary" style="font-size: 0.875rem">
                    + เพิ่มรอบการรับสมัคร
                </a>
            </div>

            {{-- Each round --}}
            @forelse ($rounds as $round)
                <div class="round-card">
                    {{-- Round header --}}
                    <div class="round-header">
                        <div>
                            <span
                                style="
                                    color: rgba(255, 163, 107, 0.9);
                                    font-size: 0.7rem;
                                    font-weight: 700;
                                    letter-spacing: 0.1em;
                                    text-transform: uppercase;
                                "
                            >
                                รอบที่ {{ $round->round_number }}
                            </span>
                            <h3
                                style="
                                    font-family: 'Playfair Display', serif;
                                    font-size: 1.2rem;
                                    font-weight: 900;
                                    color: #fff;
                                    margin: 0.2rem 0;
                                "
                            >
                                {{ $round->round_name }}
                                <span style="opacity: 0.7; font-size: 0.9rem">· {{ $round->round_name_th }}</span>
                            </h3>
                            <span
                                style="
                                    background: rgba(255, 255, 255, 0.15);
                                    color: #fff;
                                    font-size: 0.72rem;
                                    font-weight: 600;
                                    padding: 0.2rem 0.6rem;
                                    border-radius: 20px;
                                "
                            >
                                {{ $round->total_seats }} ที่นั่งรวม
                            </span>
                        </div>
                        <div class="gap-2 flex items-center">
                            <a href="{{ route('admin.admission.projects.create', $round) }}" class="action-btn btn-add-sm">
                                + เพิ่มโครงการ
                            </a>
                            <a href="{{ route('admin.admission.rounds.edit', $round) }}" class="action-btn btn-edit">✏️ แก้ไขรอบ</a>
                            <form
                                method="POST"
                                action="{{ route('admin.admission.rounds.destroy', $round) }}"
                                onsubmit="return confirm('ลบรอบนี้? โครงการทั้งหมดในรอบนี้จะถูกลบด้วย');"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="action-btn btn-delete">🗑 ลบ</button>
                            </form>
                        </div>
                    </div>

                    {{-- Projects inside this round --}}
                    <div>
                        @forelse ($round->projects as $project)
                            <div class="project-row">
                                <div>
                                    <div class="font-semibold text-sm" style="color: var(--dark)">{{ $project->project_name }}</div>
                                    <div style="color: var(--muted); font-size: 0.78rem">{{ $project->project_name_th }}</div>
                                    @if ($project->gpax_min)
                                        <span style="font-size: 0.72rem; color: var(--muted)">GPAX ≥ {{ $project->gpax_min }}</span>
                                    @endif
                                </div>
                                <div class="gap-3 flex items-center">
                                    <span class="seat-badge">{{ $project->seats }} ที่นั่ง</span>
                                    <a href="{{ route('admin.admission.projects.edit', $project) }}" class="action-btn btn-edit">✏️</a>
                                    <form
                                        method="POST"
                                        action="{{ route('admin.admission.projects.destroy', $project) }}"
                                        onsubmit="return confirm('ลบโครงการนี้?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn btn-delete">🗑</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div style="padding: 1.5rem; text-align: center; color: var(--muted); font-size: 0.875rem">
                                ยังไม่มีโครงการในรอบนี้ — กดปุ่ม "+ เพิ่มโครงการ" ด้านบน
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 4rem 0; color: var(--muted)">
                    ยังไม่มีรอบการรับสมัคร กดปุ่ม "+ เพิ่มรอบการรับสมัคร" เพื่อเริ่มต้น
                </div>
            @endforelse
        </div>
    </section>
@endsection
