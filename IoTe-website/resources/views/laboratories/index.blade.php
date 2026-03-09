@extends('layouts.app')
@section('title', 'Laboratories — IoTe KMITL')

@push('styles')
    <style>
        .lab-hero {
            background: linear-gradient(135deg, var(--crimson) 0%, var(--dark) 100%);
            padding: 7rem 0 5rem;
            position: relative;
            overflow: hidden;
        }
        .lab-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://i.pinimg.com/736x/94/b1/e7/94b1e74e89ecbc3544591b018dfab077.jpg') center/cover;
            opacity: 0.08;
        }
        .lab-card {
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border);
            background: #fff;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            flex-direction: column;
        }
        .lab-card:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: 0 24px 60px rgba(114, 10, 0, 0.16);
        }
        .lab-card-img {
            height: 260px;
            overflow: hidden;
            position: relative;
        }
        .lab-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }
        .lab-card:hover .lab-card-img img {
            transform: scale(1.06);
        }
        .lab-card-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(114, 10, 0, 0.7) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.35s;
        }
        .lab-card:hover .lab-card-img-overlay {
            opacity: 1;
        }
        .lab-number {
            position: absolute;
            top: 1rem;
            left: 1rem;
            width: 44px;
            height: 44px;
            background: var(--crimson);
            color: #fff;
            font-weight: 900;
            font-size: 1.25rem;
            font-family: 'Playfair Display', serif;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        .lab-card-body {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .lab-arrow {
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--crimson);
            text-decoration: none;
            transition:
                gap 0.2s,
                color 0.2s;
        }
        .lab-arrow:hover {
            gap: 14px;
            color: var(--orange);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: rgba(114, 10, 0, 0.08);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--crimson);
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="lab-hero">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <div class="max-w-2xl">
                <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Our Facilities</span>
                <h1
                    style="
                        font-family: 'Playfair Display', serif;
                        font-size: clamp(2.5rem, 5vw, 4rem);
                        font-weight: 900;
                        color: #fff;
                        line-height: 1.1;
                        margin-bottom: 1.5rem;
                    "
                >
                    Research
                    <br />
                    <em style="color: #ffaa77">Laboratories</em>
                </h1>
                <p style="color: rgba(255, 255, 255, 0.78); font-size: 1.125rem; line-height: 1.8; max-width: 500px">
                    Three specialized laboratories where innovation happens every day — from embedded systems to intelligent networks and
                    smart environmental engineering.
                </p>
            </div>
        </div>
    </section>

    <!-- BREADCRUMB -->
    <div style="background: var(--light); border-bottom: 1px solid var(--border); padding: 0.875rem 0">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <nav class="gap-2 text-sm flex items-center" style="color: var(--muted)">
                <a href="{{ route('home') }}" class="hover:text-crimson transition-colors" style="color: inherit">Home</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span style="color: var(--crimson); font-weight: 500">Laboratories</span>
            </nav>
        </div>
    </div>

    <!-- LAB OVERVIEW INTRO -->
    <section style="padding: 4rem 0; background: #fff">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto text-center">
            <span class="section-label">World-Class Facilities</span>
            <h2 class="section-title">Explore Our Labs</h2>
            <div class="accent-line mt-2 mx-auto"></div>
            <p class="mb-5 max-w-2xl text-lg mx-auto" style="color: var(--muted)">
                Each laboratory is equipped with industry-grade hardware and software to support cutting-edge research and hands-on student
                learning.
            </p>

            <!-- Feature highlights -->
            <div class="mt-15 gap-6 md:grid-cols-4 grid grid-cols-2 text-left">
                @foreach ([
                        ['icon' => '🔬', 'title' => 'Industry-Grade Equipment', 'desc' => 'Funded by leading technology partners'],
                        ['icon' => '🤝', 'title' => 'Open to Students', 'desc' => 'Access all year round for projects'],
                        ['icon' => '📡', 'title' => 'Connected Infrastructure', 'desc' => '5G & private network testbeds'],
                        ['icon' => '🏆', 'title' => 'Award-Winning Research', 'desc' => 'National & international recognition']
                    ]
                    as $f)
                    <div style="padding: 1.75rem; border: 1px solid var(--border); border-radius: 14px; background: var(--light)">
                        <div class="mb-3 text-3xl">{{ $f['icon'] }}</div>
                        <div class="mb-1 font-semibold" style="color: var(--dark)">{{ $f['title'] }}</div>
                        <div class="text-sm" style="color: var(--muted)">{{ $f['desc'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- LAB CARDS -->
    <section style="padding: 2rem 0 7rem; background: var(--light)">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="gap-8 md:grid-cols-3 grid grid-cols-1">
                <!-- Lab 1 -->
                <div class="lab-card">
                    <div class="lab-card-img">
                        <div class="lab-number">01</div>
                        <img src="https://i.pinimg.com/1200x/ec/9e/a2/ec9ea2077e13d4a3ec19aeaa7e79b027.jpg" alt="Lab rai wa" />
                        <div class="lab-card-img-overlay"></div>
                    </div>
                    <div class="lab-card-body">
                        <span class="tag mb-3">Cyber security.</span>
                        <h3
                            style="
                                font-family: 'Playfair Display', serif;
                                font-size: 1.5rem;
                                font-weight: 700;
                                color: var(--dark);
                                margin-bottom: 0.75rem;
                            "
                        >
                            Cybersecurity Lab
                        </h3>
                        <p class="mb-4 text-sm leading-relaxed" style="color: var(--muted)">
                            Lab cybersecurity ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ
                            มุ่งเน้นไปทีการพัฒนาและวิจัยด้านความมั่นคงปลอดภัยไซเบอร์ในระบบฝังตัวและเครือข่ายอัจฉริยะจากภาควิชาวิศวกรรมไอโอทีและสารสนเทศ
                        </p>
                        <div class="mb-6 gap-2 flex flex-wrap">
                            @foreach (['FPGA', 'ARM Cortex', 'PCB Design', 'RTOS', 'Edge AI'] as $t)
                                <span class="tag" style="font-size: 0.7rem">{{ $t }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('laboratories.show', 1) }}" class="lab-arrow">
                            Explore This Lab
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
