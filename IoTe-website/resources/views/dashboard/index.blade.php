@extends('layouts.app')
@section('title', 'Dashboard — IoTe KMITL')

@push('styles')
    <style>
        .dash-hero {
            background: var(--dark);
            padding: 5rem 0 3.5rem;
            position: relative;
            overflow: hidden;
        }
        .dash-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 65% 50%, rgba(114, 10, 0, 0.4), transparent 65%);
        }
        .dash-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition:
                box-shadow 0.25s,
                transform 0.25s;
        }
        .dash-card:hover {
            box-shadow: 0 16px 48px rgba(114, 10, 0, 0.09);
            transform: translateY(-3px);
        }
        .nav-action {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.1rem 1.4rem;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            background: #fff;
            text-decoration: none;
            transition: all 0.2s;
            color: var(--dark);
        }
        .nav-action:hover {
            border-color: var(--crimson);
            box-shadow: 0 6px 20px rgba(114, 10, 0, 0.1);
            transform: translateY(-2px);
        }
        .nav-action-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="dash-hero">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <div class="gap-6 flex flex-wrap items-center justify-between">
                <div>
                    <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Dashboard · สรุปภาพรวม</span>
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
                        สวัสดี,
                        <em style="color: #ffaa77">{{ Auth::user()->name }}</em>
                    </h1>
                    <p style="color: rgba(255, 255, 255, 0.62); font-size: 0.9rem">
                        ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ · King Mongkut's Institute of Technology Ladkrabang
                    </p>
                </div>

                <!-- User badge -->
                <div
                    class="gap-4 p-4 rounded-2xl flex items-center"
                    style="background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.1)"
                >
                    @if (Auth::user()->avatar)
                        <img
                            src="{{ Auth::user()->avatar }}"
                            width="52"
                            height="52"
                            style="border-radius: 50%; border: 2px solid rgba(255, 255, 255, 0.25)"
                            alt="Avatar"
                        />
                    @else
                        <div
                            style="
                                width: 52px;
                                height: 52px;
                                border-radius: 50%;
                                background: var(--crimson);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            "
                        >
                            <span style="color: #fff; font-weight: 700; font-size: 1.3rem; font-family: 'Playfair Display', serif">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    <div>
                        <div style="color: #fff; font-weight: 600; font-size: 0.9rem">{{ Auth::user()->name }}</div>
                        <div style="color: rgba(255, 255, 255, 0.5); font-size: 0.75rem">{{ Auth::user()->email }}</div>
                        <span
                            style="
                                display: inline-block;
                                margin-top: 0.3rem;
                                background: var(--crimson);
                                color: #fff;
                                font-size: 0.62rem;
                                font-weight: 700;
                                letter-spacing: 0.08em;
                                text-transform: uppercase;
                                padding: 0.15rem 0.6rem;
                                border-radius: 20px;
                            "
                        >
                            {{ Auth::user()->role ?? 'User' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BODY -->
    <section style="padding: 3.5rem 0; background: var(--light); min-height: 55vh">
        <div class="max-w-5xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="lg:grid-cols-3 gap-8 grid grid-cols-1">
                <!-- Navigation Panel -->
                <div class="lg:col-span-2">
                    <div class="dash-card">
                        <div class="p-6 border-b" style="border-color: var(--border)">
                            <span class="section-label">Navigation</span>
                            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.35rem; font-weight: 900; color: var(--dark)">
                                เมนูนำทาง
                            </h2>
                        </div>
                        <div class="p-6 sm:grid-cols-2 gap-3 grid grid-cols-1">
                            @if (Auth::user()->role === 'admin')
                                <a
                                    href="{{ route('admin') }}"
                                    class="nav-action"
                                    style="border-color: rgba(114, 10, 0, 0.2); background: rgba(114, 10, 0, 0.03)"
                                >
                                    <div class="nav-action-icon" style="background: rgba(114, 10, 0, 0.1)">
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
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm" style="color: var(--crimson)">Admin Dashboard</div>
                                        <div class="text-xs" style="color: var(--muted)">จัดการข้อมูลระบบ</div>
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
                            @endif

                            <a href="{{ route('course.index') }}" class="nav-action">
                                <div class="nav-action-icon" style="background: rgba(114, 10, 0, 0.08)">
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
                                    <div class="font-semibold text-sm" style="color: var(--dark)">รายวิชา</div>
                                    <div class="text-xs" style="color: var(--muted)">จัดการหลักสูตรและรายวิชา</div>
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

                            <a href="{{ route('reservations.index') }}" class="nav-action">
                                <div class="nav-action-icon" style="background: rgba(107, 99, 96, 0.08)">
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
                                    <div class="font-semibold text-sm" style="color: var(--dark)">ยืมอุปกรณ์และเครื่องมือภาควิชา</div>
                                    <div class="text-xs" style="color: var(--muted)">จัดการการยืมอุปกรณ์และเครื่องมือของภาควิชา</div>
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
                                <button type="submit" class="nav-action w-full" style="cursor: pointer; border-color: #fecaca">
                                    <div class="nav-action-icon" style="background: #fef2f2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #dc2626">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            />
                                        </svg>
                                    </div>
                                    <div class="flex-1 text-left">
                                        <div class="font-semibold text-sm" style="color: #dc2626">ออกจากระบบ</div>
                                        <div class="text-xs" style="color: var(--muted)">Logout</div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Card -->
                <div class="space-y-5">
                    <div class="dash-card">
                        <div class="p-5 border-b" style="border-color: var(--border)">
                            <span class="section-label">Account</span>
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 900; color: var(--dark)">
                                โปรไฟล์ของคุณ
                            </h3>
                        </div>
                        <div class="p-5">
                            <div class="gap-3 mb-5 flex items-center">
                                @if (Auth::user()->avatar)
                                    <img
                                        src="{{ Auth::user()->avatar }}"
                                        width="52"
                                        height="52"
                                        style="border-radius: 50%; border: 2px solid var(--border)"
                                    />
                                @else
                                    <div
                                        style="
                                            width: 52px;
                                            height: 52px;
                                            border-radius: 50%;
                                            background: linear-gradient(135deg, var(--crimson), var(--orange));
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            flex-shrink: 0;
                                        "
                                    >
                                        <span
                                            style="color: #fff; font-weight: 700; font-size: 1.3rem; font-family: 'Playfair Display', serif"
                                        >
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-sm" style="color: var(--dark)">{{ Auth::user()->name }}</div>
                                    <div class="text-xs mt-0.5" style="color: var(--muted)">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="py-2.5 flex justify-between" style="border-bottom: 1px solid var(--border)">
                                    <span style="color: var(--muted)">Role</span>
                                    <span class="font-semibold" style="color: var(--crimson)">{{ Auth::user()->role ?? 'User' }}</span>
                                </div>
                                <div class="py-2.5 flex justify-between">
                                    <span style="color: var(--muted)">Status</span>
                                    <span class="gap-1.5 font-semibold flex items-center" style="color: #16a34a">
                                        <span
                                            style="width: 7px; height: 7px; border-radius: 50%; background: #16a34a; display: inline-block"
                                        ></span>
                                        Active
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="dash-card p-5" style="background: linear-gradient(135deg, var(--crimson), var(--orange)); border: none">
                        <div style="font-size: 1.4rem; margin-bottom: 0.6rem">🎓</div>
                        <h4
                            style="
                                font-family: 'Playfair Display', serif;
                                font-size: 0.95rem;
                                font-weight: 700;
                                color: #fff;
                                margin-bottom: 0.4rem;
                            "
                        >
                            IoTe KMITL
                        </h4>
                        <p style="font-size: 0.78rem; color: rgba(255, 255, 255, 0.8); margin-bottom: 1rem; line-height: 1.6">
                            ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ
                            <br />
                            คณะวิศวกรรมศาสตร์ สจล.
                        </p>
                        <a
                            href="{{ route('home') }}"
                            style="
                                display: inline-block;
                                background: rgba(255, 255, 255, 0.2);
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                color: #fff;
                                font-size: 0.78rem;
                                font-weight: 600;
                                padding: 0.45rem 1rem;
                                border-radius: 8px;
                                text-decoration: none;
                            "
                        >
                            Visit Website →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
