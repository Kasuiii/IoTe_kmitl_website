@extends('layouts.app')
@section('title', 'Login — IoTe KMITL')

@push('styles')
    <style>
        .login-hero {
            min-height: calc(100vh - 4rem);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--dark);
            position: relative;
            overflow: hidden;
            padding: 4rem 1rem;
        }
        .login-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 30% 60%, rgba(114, 10, 0, 0.5), transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(227, 82, 5, 0.2), transparent 50%);
        }
        .login-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
        }
        .login-card-top {
            background: linear-gradient(135deg, var(--crimson), var(--orange));
            padding: 2.5rem 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .login-card-top::after {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            bottom: -100px;
            right: -60px;
        }
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.9rem 1.5rem;
            background: #fff;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .google-btn:hover {
            border-color: var(--crimson);
            box-shadow: 0 4px 16px rgba(114, 10, 0, 0.12);
            transform: translateY(-1px);
        }
        .alert-error {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
        .alert-success {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-top: 1.25rem;
        }
    </style>
@endpush

@section('content')
    <div class="login-hero">
        <!-- Background decorative text -->
        <div
            style="
                position: absolute;
                bottom: 3rem;
                left: 3rem;
                font-family: 'Playfair Display', serif;
                font-size: 8rem;
                font-weight: 900;
                color: rgba(255, 255, 255, 0.03);
                line-height: 1;
                user-select: none;
                z-index: 0;
            "
        >
            IoTe
        </div>
        <div
            style="
                position: absolute;
                top: 4rem;
                right: 4rem;
                font-family: 'Playfair Display', serif;
                font-size: 5rem;
                font-weight: 900;
                color: rgba(255, 255, 255, 0.03);
                line-height: 1;
                user-select: none;
                z-index: 0;
            "
        >
            KMITL
        </div>

        <div class="login-card">
            <!-- Card Header -->
            <div class="login-card-top">
                <div class="gap-2 mb-4 flex items-center justify-center">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2)">
                        <span class="font-bold text-white text-lg" style="font-family: 'Playfair Display', serif">Io</span>
                    </div>
                    <span class="text-white font-bold text-xl" style="font-family: 'Playfair Display', serif">IoTe KMITL</span>
                </div>
                <h1
                    style="font-family: 'Playfair Display', serif; font-size: 1.75rem; font-weight: 900; color: #fff; margin-bottom: 0.5rem"
                >
                    Staff Portal
                </h1>
                <p style="color: rgba(255, 255, 255, 0.78); font-size: 0.875rem">ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ · KMITL</p>
            </div>

            <!-- Card Body -->
            <div style="padding: 2.5rem">
                @if (session('error'))
                    <div class="alert-error">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                            />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <p class="text-sm mb-6" style="color: var(--muted); line-height: 1.7">
                    ระบบนี้สำหรับเจ้าหน้าที่และอาจารย์ของ IoTe KMITL เท่านั้น กรุณาเข้าสู่ระบบด้วยบัญชี Google ของ KMITL
                </p>

                <a href="{{ route('google.login') }}" class="google-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24">
                        <path
                            fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        />
                        <path
                            fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        />
                        <path
                            fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                        />
                        <path
                            fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                        />
                    </svg>
                    <span>Sign in with Google</span>
                    <span style="font-size: 0.8rem; font-weight: 400; color: var(--muted)">
                        @kmitl.ac.th
                        only
                    </span>
                </a>

                @if (session('success'))
                    <div class="alert-success">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Divider -->
                <div class="gap-3 my-6 flex items-center">
                    <div class="h-px flex-1" style="background: var(--border)"></div>
                    <span style="font-size: 0.75rem; color: var(--muted); font-weight: 500">KMITL Staff Only</span>
                    <div class="h-px flex-1" style="background: var(--border)"></div>
                </div>

                <div class="text-center">
                    <p style="font-size: 0.8rem; color: var(--muted); line-height: 1.7">
                        หากไม่ใช่บุคลากร IoTe กรุณาติดต่อ
                        <br />
                        <a href="mailto:iote@kmitl.ac.th" style="color: var(--crimson); font-weight: 600">iote@kmitl.ac.th</a>
                    </p>
                </div>
            </div>

            <!-- Card Footer -->
            <div style="padding: 1.25rem 2.5rem; background: var(--light); border-top: 1px solid var(--border)">
                <div class="text-xs flex items-center justify-between" style="color: var(--muted)">
                    <span>© {{ date('Y') }} IoTe KMITL</span>
                    <a
                        href="{{ route('home') }}"
                        class="gap-1 flex items-center transition-colors"
                        style="color: var(--muted)"
                        onmouseover="this.style.color = 'var(--crimson)'"
                        onmouseout="this.style.color = 'var(--muted)'"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Website
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
