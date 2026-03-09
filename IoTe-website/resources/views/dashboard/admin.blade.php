@extends('layouts.app')
@section('title', 'Admin Dashboard — IoTe KMITL')

@push('styles')
    <style>
        .admin-hero {
            background: var(--dark);
            padding: 5rem 0 3.5rem;
            position: relative;
            overflow: hidden;
        }
        .admin-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(114, 10, 0, 0.4), transparent 65%);
        }

        .admin-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            transition:
                box-shadow 0.25s,
                transform 0.25s;
        }
        .admin-card:hover {
            box-shadow: 0 16px 48px rgba(114, 10, 0, 0.1);
            transform: translateY(-4px);
        }

        .stat-mini {
            background: linear-gradient(135deg, var(--crimson), var(--orange));
            border-radius: 14px;
            padding: 1.5rem;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .stat-mini::before {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            top: -20px;
            right: -20px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border-radius: 14px;
            border: 1.5px solid var(--border);
            background: #fff;
            text-decoration: none;
            transition: all 0.2s;
            color: var(--dark);
        }
        .action-btn:hover {
            border-color: var(--crimson);
            box-shadow: 0 8px 24px rgba(114, 10, 0, 0.1);
            transform: translateY(-2px);
        }
        .action-btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
    </style>
@endpush

@section('content')
    <!-- ═══ HERO ═══ -->
    <section class="admin-hero">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <div class="gap-6 flex flex-wrap items-center justify-between">
                <div>
                    <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Admin Portal · ระบบจัดการ</span>
                    <h1
                        style="
                            font-family: 'Playfair Display', serif;
                            font-size: clamp(1.75rem, 4vw, 3rem);
                            font-weight: 900;
                            color: #fff;
                            line-height: 1.2;
                            margin-bottom: 0.75rem;
                        "
                    >
                        ยินดีต้อนรับ,
                        <br />
                        <em style="color: #ffaa77">{{ Auth::user()->name }}</em>
                    </h1>
                    <p style="color: rgba(255, 255, 255, 0.65); font-size: 0.95rem">
                        ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ · IoTe KMITL Admin Dashboard
                    </p>
                </div>

                <!-- User Badge -->
                <div
                    class="gap-4 p-4 rounded-2xl flex items-center"
                    style="background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.1)"
                >
                    @if (Auth::user()->avatar)
                        <img
                            src="{{ Auth::user()->avatar }}"
                            width="52"
                            height="52"
                            style="border-radius: 50%; border: 2px solid rgba(255, 255, 255, 0.3)"
                            alt="Avatar"
                        />
                    @else
                        <div
                            class="w-13 h-13 flex items-center justify-center rounded-full"
                            style="background: var(--crimson); width: 52px; height: 52px"
                        >
                            <span style="color: #fff; font-weight: 700; font-size: 1.25rem; font-family: 'Playfair Display', serif">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    <div>
                        <div style="color: #fff; font-weight: 600; font-size: 0.95rem">{{ Auth::user()->name }}</div>
                        <div style="color: rgba(255, 255, 255, 0.55); font-size: 0.8rem">{{ Auth::user()->email }}</div>
                        <span
                            style="
                                display: inline-block;
                                margin-top: 0.25rem;
                                background: var(--crimson);
                                color: #fff;
                                font-size: 0.65rem;
                                font-weight: 700;
                                letter-spacing: 0.08em;
                                text-transform: uppercase;
                                padding: 0.15rem 0.6rem;
                                border-radius: 20px;
                            "
                        >
                            {{ Auth::user()->role ?? 'Admin' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ DASHBOARD BODY ═══ -->
    <section style="padding: 3.5rem 0; background: var(--light); min-height: 60vh">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <!-- Quick Stats Row -->
            <div class="md:grid-cols-4 gap-5 mb-10 grid grid-cols-2">
                @foreach ([
                        ['📚', 'รายวิชา', 'Courses'],
                        ['👥', 'ผู้ใช้งาน', 'Users'],
                        ['🏫', 'ห้องปฏิบัติการ', 'Laboratories'],
                        ['📋', 'การรับสมัคร', 'Admissions']
                    ]
                    as [$icon, $label, $en])
                    <div class="stat-mini">
                        <div style="font-size: 1.75rem; margin-bottom: 0.5rem">{{ $icon }}</div>
                        <div
                            style="
                                font-size: 0.7rem;
                                opacity: 0.75;
                                letter-spacing: 0.08em;
                                text-transform: uppercase;
                                margin-bottom: 0.25rem;
                            "
                        >
                            {{ $en }}
                        </div>
                        <div style="font-weight: 700; font-size: 0.9rem">{{ $label }}</div>
                    </div>
                @endforeach
            </div>

            <div class="lg:grid-cols-3 gap-8 grid grid-cols-1">
                <!-- Quick Actions -->
                <div class="lg:col-span-2">
                    <div class="admin-card">
                        <div class="p-6 border-b" style="border-color: var(--border)">
                            <span class="section-label">Management</span>
                            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 900; color: var(--dark)">
                                Quick Actions
                            </h2>
                        </div>
                        <div class="p-6 sm:grid-cols-2 gap-4 grid grid-cols-1">
                            <a href="{{ route('course.index') }}" class="action-btn">
                                <div class="action-btn-icon" style="background: rgba(114, 10, 0, 0.08)">
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        style="color: var(--crimson)"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm" style="color: var(--dark)">จัดการรายวิชา</div>
                                    <div class="text-xs" style="color: var(--muted)">เพิ่ม แก้ไข และลบรายวิชา</div>
                                </div>
                                <svg
                                    class="w-4 h-4 ml-auto"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    style="color: var(--muted)"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('reservations.admin') }}" class="action-btn">
                                <div class="action-btn-icon" style="background: rgba(227, 82, 5, 0.08)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--orange)">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm" style="color: var(--dark)">จัดการอุปกรณ์</div>
                                    <div class="text-xs" style="color: var(--muted)">จัดการข้อมูลอุปกรณ์และเครื่องมือภาควิชา</div>
                                </div>
                                <svg
                                    class="w-4 h-4 ml-auto"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    style="color: var(--muted)"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.faculty.index') }}" class="action-btn">
                                <div class="action-btn-icon" style="background: rgba(22, 123, 0, 0.08)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #167b00">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm" style="color: var(--dark)">หน้าคณาจารย์</div>
                                    <div class="text-xs" style="color: var(--muted)">ดูข้อมูลอาจารย์</div>
                                </div>
                                <svg
                                    class="w-4 h-4 ml-auto"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    style="color: var(--muted)"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.admission.index') }}" class="action-btn">
                                <div class="action-btn-icon" style="background: rgba(59, 130, 246, 0.08)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #3b82f6">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm" style="color: var(--dark)">การรับสมัคร</div>
                                    <div class="text-xs" style="color: var(--muted)">ดูข้อมูลการรับสมัคร</div>
                                </div>
                                <svg
                                    class="w-4 h-4 ml-auto"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    style="color: var(--muted)"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('home') }}" class="action-btn">
                                <div class="action-btn-icon" style="background: rgba(107, 99, 96, 0.08)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--muted)">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm" style="color: var(--dark)">กลับหน้าหลัก</div>
                                    <div class="text-xs" style="color: var(--muted)">ดูหน้าเว็บไซต์หลัก</div>
                                </div>
                                <svg
                                    class="w-4 h-4 ml-auto"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    style="color: var(--muted)"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <form method="POST" action="{{ route('logout') }}" style="display: block">
                                @csrf
                                <button type="submit" class="action-btn w-full" style="cursor: pointer; border-color: #fecaca">
                                    <div class="action-btn-icon" style="background: #fef2f2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #dc2626">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm" style="color: #dc2626">ออกจากระบบ</div>
                                        <div class="text-xs" style="color: var(--muted)">Logout from Admin Portal</div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile & Info Panel -->
                <div class="space-y-6">
                    <!-- Profile Card -->
                    <div class="admin-card">
                        <div class="p-5 border-b" style="border-color: var(--border)">
                            <span class="section-label">Account</span>
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.15rem; font-weight: 900; color: var(--dark)">
                                Your Profile
                            </h3>
                        </div>
                        <div class="p-5">
                            <div class="gap-4 mb-5 flex items-center">
                                @if (Auth::user()->avatar)
                                    <img
                                        src="{{ Auth::user()->avatar }}"
                                        width="56"
                                        height="56"
                                        style="border-radius: 50%; border: 2px solid var(--border)"
                                        alt="Avatar"
                                    />
                                @else
                                    <div
                                        style="
                                            width: 56px;
                                            height: 56px;
                                            border-radius: 50%;
                                            background: linear-gradient(135deg, var(--crimson), var(--orange));
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                        "
                                    >
                                        <span
                                            style="color: #fff; font-weight: 700; font-size: 1.4rem; font-family: 'Playfair Display', serif"
                                        >
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold" style="color: var(--dark)">{{ Auth::user()->name }}</div>
                                    <div class="text-xs" style="color: var(--muted)">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="py-2 flex items-center justify-between" style="border-bottom: 1px solid var(--border)">
                                    <span style="color: var(--muted)">Role</span>
                                    <span class="font-semibold" style="color: var(--crimson)">{{ Auth::user()->role ?? 'Admin' }}</span>
                                </div>
                                <div class="py-2 flex items-center justify-between">
                                    <span style="color: var(--muted)">Status</span>
                                    <span class="gap-1.5 font-semibold flex items-center" style="color: #16a34a">
                                        <span
                                            style="width: 8px; height: 8px; border-radius: 50%; background: #16a34a; display: inline-block"
                                        ></span>
                                        Active
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help Card -->
                    <div class="admin-card p-5" style="background: linear-gradient(135deg, var(--crimson), var(--orange)); border: none">
                        <div style="font-size: 1.5rem; margin-bottom: 0.75rem">💡</div>
                        <h4
                            style="
                                font-family: 'Playfair Display', serif;
                                font-size: 1rem;
                                font-weight: 700;
                                color: #fff;
                                margin-bottom: 0.5rem;
                            "
                        >
                            ต้องการความช่วยเหลือ?
                        </h4>
                        <p style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.8); margin-bottom: 1rem; line-height: 1.6">
                            ติดต่อผู้ดูแลระบบหรือส่งอีเมลหาเรา
                        </p>
                        <a
                            href="mailto:iote@kmitl.ac.th"
                            style="
                                display: inline-block;
                                background: rgba(255, 255, 255, 0.2);
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                color: #fff;
                                font-size: 0.8rem;
                                font-weight: 600;
                                padding: 0.5rem 1rem;
                                border-radius: 8px;
                                text-decoration: none;
                            "
                        >
                            iote@kmitl.ac.th
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
