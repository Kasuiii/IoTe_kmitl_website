@extends('layouts.app')
@section('title', 'Admission — IoTe KMITL')

@push('styles')
    <style>
        .round-card {
            border-radius: 20px;
            border: 2px solid var(--border);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: box-shadow 0.25s;
        }
        .round-card:hover {
            box-shadow: 0 12px 36px rgba(114, 10, 0, 0.09);
        }
        .round-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.75rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .round-1 .round-header {
            background: linear-gradient(135deg, var(--crimson), #a01200);
            color: #fff;
        }
        .round-2 .round-header {
            background: linear-gradient(135deg, var(--orange), #c44600);
            color: #fff;
        }
        .round-3 .round-header {
            background: linear-gradient(135deg, var(--dark), #3a2020);
            color: #fff;
        }
        .round-body {
            padding: 1.5rem;
            background: #fff;
        }
        .project-item {
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }
        .project-item:last-child {
            margin-bottom: 0;
        }
        .project-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.25rem;
            background: var(--light);
            cursor: pointer;
            gap: 1rem;
        }
        .project-header:hover {
            background: #ede8e6;
        }
        .project-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
            padding: 0 1.25rem;
        }
        .project-item.open .project-body {
            max-height: 600px;
            padding: 1.25rem;
        }
        .project-icon {
            transition: transform 0.3s;
            color: var(--crimson);
            flex-shrink: 0;
        }
        .project-item.open .project-icon {
            transform: rotate(45deg);
        }
        .req-bullet {
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
            font-size: 0.875rem;
            padding: 0.375rem 0;
            color: var(--dark);
        }
        .req-bullet::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--crimson);
            margin-top: 7px;
            flex-shrink: 0;
        }
        .seats-badge {
            background: var(--crimson);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.2rem 0.75rem;
            border-radius: 20px;
            white-space: nowrap;
        }
        .score-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.875rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border);
        }
        .score-row:nth-child(odd) {
            background: var(--light);
        }
        .score-bar {
            height: 6px;
            border-radius: 3px;
            background: linear-gradient(90deg, var(--crimson), var(--orange));
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section
        style="background: linear-gradient(135deg, var(--crimson), #a01200); padding: 7rem 0 5rem; position: relative; overflow: hidden"
    >
        <div
            style="
                position: absolute;
                inset: 0;
                background: url('https://lh3.googleusercontent.com/gg-dl/AOI_d_-IOuy6LrDiNfLvFXxLB-MQlumWblX-r4Dxdy0ra-kqUHgJM6Lm74kvzC6n2Aw6_eIK-6_40Iiadfv_xsooH0_Pl_s_59goJc6BLGXJUufDI61LY-das89IJxN_G5qTUGCVbk_5eIDU5EpUqsznXTCGBga6CIV01t8TZTaMNi3ajIB-=s1024-rj')
                    center/cover;
                opacity: 0.7;
            "
        ></div>
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Join IoTe KMITL</span>
            <h1
                style="
                    font-family: 'Playfair Display', serif;
                    font-size: clamp(2.5rem, 5vw, 4rem);
                    font-weight: 900;
                    color: #fff;
                    line-height: 1.1;
                    max-width: 700px;
                    margin-bottom: 1.5rem;
                "
            >
                Admission
                <br />
                <em style="color: #ffaa77">2025 – 2026</em>
            </h1>
            <p style="color: rgba(255, 255, 255, 0.85); font-size: 1.125rem; line-height: 1.8; max-width: 560px; margin-bottom: 2.5rem">
                หลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ
                <br />
                <span style="font-size: 0.95rem">B.Eng. IoT System and Information Engineering — Ladkrabang Campus</span>
            </p>

            <!-- Seat summary cards -->
            <div class="gap-4 flex flex-wrap">
                <div
                    style="
                        background: rgba(255, 255, 255, 0.12);
                        backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        padding: 1rem 1.75rem;
                        border-radius: 12px;
                        color: #fff;
                        text-align: center;
                    "
                >
                    <div class="text-3xl font-black" style="font-family: 'Playfair Display', serif">75</div>
                    <div class="mt-1 text-xs opacity-75">รอบ 1 Portfolio</div>
                </div>
                <div
                    style="
                        background: rgba(255, 255, 255, 0.12);
                        backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        padding: 1rem 1.75rem;
                        border-radius: 12px;
                        color: #fff;
                        text-align: center;
                    "
                >
                    <div class="text-3xl font-black" style="font-family: 'Playfair Display', serif">15</div>
                    <div class="mt-1 text-xs opacity-75">รอบ 2 Quota</div>
                </div>
                <div
                    style="
                        background: rgba(255, 255, 255, 0.12);
                        backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        padding: 1rem 1.75rem;
                        border-radius: 12px;
                        color: #fff;
                        text-align: center;
                    "
                >
                    <div class="text-3xl font-black" style="font-family: 'Playfair Display', serif">5</div>
                    <div class="mt-1 text-xs opacity-75">รอบ 3 Admission</div>
                </div>
                <div
                    style="
                        background: rgba(255, 255, 255, 0.12);
                        backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        padding: 1rem 1.75rem;
                        border-radius: 12px;
                        color: #fff;
                        text-align: center;
                    "
                >
                    <div class="text-3xl font-black" style="font-family: 'Playfair Display', serif">25,000 ฿</div>
                    <div class="mt-1 text-xs opacity-75">ค่าธรรมเนียม / ภาค</div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROGRAMME DETAIL -->
    <section style="background: var(--light); padding: 3rem 0; border-bottom: 1px solid var(--border)">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="gap-6 text-sm md:grid-cols-4 grid grid-cols-2">
                @foreach ([
                        ['label' => 'ชื่อหลักสูตร', 'value' => 'วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ'],
                        ['label' => 'English Name', 'value' => 'B.Eng. IoT System and Information Engineering'],
                        ['label' => 'ประเภทหลักสูตร', 'value' => 'ภาษาไทย ปกติ'],
                        ['label' => 'วิทยาเขต', 'value' => 'ลาดกระบัง (Ladkrabang)']
                    ]
                    as $info)
                    <div style="background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem">
                        <div class="mb-1 text-xs font-semibold tracking-wider uppercase" style="color: var(--orange)">
                            {{ $info['label'] }}
                        </div>
                        <div class="font-medium" style="color: var(--dark)">{{ $info['value'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ADMISSION ROUNDS -->
    <section style="padding: 5rem 0; background: #fff">
        <div class="max-w-5xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="mb-12 text-center">
                <span class="section-label">TCAS Admission</span>
                <h2 class="section-title">รอบการรับสมัคร</h2>
                <div class="accent-line mt-4 mx-auto"></div>
                <p class="mt-4" style="color: var(--muted)">คลิกที่แต่ละโครงการเพื่อดูรายละเอียดคุณสมบัติ</p>
            </div>

            @foreach ($rounds as $round)
                <div class="round-card round-{{ $round->round_number }}">
                    <div
                        class="round-header"
                        onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? '' : 'none'"
                    >
                        <div class="gap-4 flex items-center">
                            <div
                                style="
                                    width: 48px;
                                    height: 48px;
                                    background: rgba(255, 255, 255, 0.15);
                                    border-radius: 12px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-family: 'Playfair Display', serif;
                                    font-weight: 900;
                                    font-size: 1.25rem;
                                "
                            >
                                {{ $round->round_number }}
                            </div>

                            <div>
                                <div class="text-lg font-bold">รอบที่ {{ $round->round_number }} · {{ $round->round_name }}</div>

                                <div style="font-size: 0.8125rem; opacity: 0.8">
                                    {{ $round->projects->count() }} โครงการ · รับรวม {{ $round->total_seats }} คน
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="round-body">
                        @foreach ($round->projects->sortBy('sort_order') as $project)
                            <div class="project-item">
                                <div class="project-header" onclick="this.closest('.project-item').classList.toggle('open')">
                                    <div class="min-w-0 gap-3 flex items-center">
                                        <svg class="project-icon h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>

                                        <span class="text-sm font-semibold truncate" style="color: var(--dark)">
                                            {{ $project->project_name_th }}
                                        </span>
                                    </div>

                                    <span class="seats-badge shrink-0">{{ $project->seats }} คน</span>
                                </div>

                                <div class="project-body">
                                    <p class="mb-2 text-xs font-semibold tracking-wider uppercase" style="color: var(--orange)">
                                        คุณสมบัติผู้สมัคร
                                    </p>

                                    @foreach (explode("\n", $project->requirements) as $req)
                                        <div class="req-bullet">
                                            {{ $req }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- FEE INFO -->
    <section style="padding: 5rem 0; background: var(--light)">
        <div class="max-w-5xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="mb-10 text-center">
                <span class="section-label">ค่าใช้จ่าย</span>
                <h2 class="section-title" style="font-size: 2rem">Tuition Fees</h2>
                <div class="accent-line mt-4 mx-auto"></div>
            </div>
            <div class="gap-6 md:grid-cols-3 grid grid-cols-1">
                <div
                    style="
                        background: #fff;
                        border: 1px solid var(--border);
                        border-top: 4px solid var(--crimson);
                        border-radius: 14px;
                        padding: 2rem;
                        text-align: center;
                    "
                >
                    <div class="mb-2 text-3xl font-black" style="font-family: 'Playfair Display', serif; color: var(--crimson)">
                        25,000 ฿
                    </div>
                    <div class="mb-1 font-semibold" style="color: var(--dark)">ค่าธรรมเนียมการศึกษา</div>
                    <div class="text-sm" style="color: var(--muted)">ต่อภาคการศึกษา</div>
                </div>
                <div
                    style="
                        background: #fff;
                        border: 1px solid var(--border);
                        border-top: 4px solid var(--orange);
                        border-radius: 14px;
                        padding: 2rem;
                        text-align: center;
                    "
                >
                    <div class="mb-2 text-3xl font-black" style="font-family: 'Playfair Display', serif; color: var(--orange)">
                        200,000 ฿
                    </div>
                    <div class="mb-1 font-semibold" style="color: var(--dark)">ค่าใช้จ่ายโดยประมาณ</div>
                    <div class="text-sm" style="color: var(--muted)">ตลอดหลักสูตร 4 ปี</div>
                </div>
                <div
                    style="
                        background: linear-gradient(135deg, var(--crimson), var(--orange));
                        border-radius: 14px;
                        padding: 2rem;
                        text-align: center;
                        color: #fff;
                    "
                >
                    <div class="mb-2 text-2xl font-black" style="font-family: 'Playfair Display', serif">กยศ / กรอ</div>
                    <div class="mb-1 font-semibold">กองทุนเงินให้กู้ยืม</div>
                    <div class="text-sm opacity-85">สามารถขอกู้ยืมได้ตามเกณฑ์ของกองทุน</div>
                </div>
            </div>
        </div>
    </section>

    <!-- APPLY CTA -->
    <section style="background: var(--dark); padding: 5rem 0">
        <div class="max-w-3xl px-4 mx-auto text-center">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2.25rem; font-weight: 900; color: #fff; margin-bottom: 1rem">
                พร้อมสมัครแล้วหรือยัง?
            </h2>
            <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 2rem; font-size: 1.0625rem">
                ดูรายละเอียดทั้งหมดและสมัครผ่านระบบรับสมัครของ สจล. ได้เลย
            </p>
            <div class="gap-4 flex flex-wrap justify-center">
                <a href="https://new.reg.kmitl.ac.th/admission/#/" target="_blank" class="btn-primary px-8 py-3 text-base">
                    สมัครเรียน — KMITL Admission
                </a>
                <a
                    href="{{ route('faculty.index') }}"
                    class="btn-outline px-8 py-3 text-base"
                    style="border-color: rgba(255, 255, 255, 0.4); color: #fff"
                    onmouseover="this.style.background = 'rgba(255,255,255,0.1)'"
                    onmouseout="this.style.background = 'transparent'"
                >
                    ดูคณาจารย์
                </a>
            </div>
        </div>
    </section>
@endsection
