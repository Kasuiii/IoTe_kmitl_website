@extends('layouts.app')
@section('title', 'about_us')

@push('styles')
    <style>
        .year-tab {
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            border: 2px solid var(--border);
            background: #fff;
            color: var(--muted);
            transition: all 0.2s;
        }
        .year-tab.active,
        .year-tab:hover {
            border-color: var(--crimson);
            color: var(--crimson);
            background: rgba(114, 10, 0, 0.05);
        }
        .year-tab.active {
            background: var(--crimson);
            color: #fff;
            border-color: var(--crimson);
        }
        .year-content {
            display: none;
        }
        .year-content.active {
            display: block;
        }
        .course-row {
            display: grid;
            grid-template-columns: 120px 1fr 80px 120px;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            align-items: center;
            border: 1px solid transparent;
            transition: all 0.2s;
        }
        .course-row:hover {
            background: var(--light);
            border-color: var(--border);
        }
        @media (max-width: 640px) {
            .course-row {
                grid-template-columns: 1fr 1fr;
            }
            .course-row .course-credit,
            .course-row .course-type {
                font-size: 0.75rem;
            }
        }
        .semester-block {
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .semester-header {
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            background: var(--light);
            transition: background 0.2s;
        }
        .semester-header:hover {
            background: #ede8e6;
        }
        .semester-body {
            padding: 0 1rem 1rem;
        }
        .credit-badge {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 5px;
            background: rgba(114, 10, 0, 0.08);
            color: var(--crimson);
        }
        .type-core {
            background: rgba(114, 10, 0, 0.1);
            color: var(--crimson);
        }
        .type-elective {
            background: rgba(227, 82, 5, 0.1);
            color: var(--orange);
        }
        .type-gen {
            background: rgba(107, 99, 96, 0.1);
            color: var(--muted);
        }
        .type-lab {
            background: rgba(22, 123, 0, 0.1);
            color: #167b00;
        }

        /* Programme Cards */
        .programme-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 280px;
            min-height: 140px;
            background: var(--dark);
            border-radius: 16px;
            padding: 2rem 1.5rem;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            line-height: 1.5;
            transition:
                transform 0.2s,
                box-shadow 0.2s;
            border: 2px solid transparent;
        }
        .programme-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.18);
            border-color: var(--crimson);
        }
        .programme-card .card-subtitle {
            opacity: 0.7;
            font-size: 0.82rem;
            font-weight: 400;
            margin-top: 0.4rem;
            line-height: 1.4;
        }
        .programme-card .card-icon {
            font-size: 1.75rem;
            margin-bottom: 0.75rem;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section style="background: var(--dark); padding: 7rem 0 5rem; position: relative; overflow: hidden">
        <div style="position: absolute; inset: 0; background: url('uuu.jpg') center/cover; opacity: 0.7"></div>
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative">
            <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">หลักสูตรวิศวกรรมศาสตรบัณฑิต · B.Eng Curriculum</span>
            <h1
                style="
                    font-family: 'Playfair Display', serif;
                    font-size: clamp(2.5rem, 5vw, 4rem);
                    font-weight: 900;
                    color: #fff;
                    line-height: 1.1;
                    max-width: 780px;
                    margin-bottom: 1.25rem;
                "
            >
                วศ.บ. วิศวกรรมระบบไอโอที
                <br />
                และสารสนเทศ &amp;
                <br />
                <em style="color: #ffaa77">Programme Structure</em>
            </h1>
            <p style="color: rgba(255, 255, 255, 0.75); font-size: 1.125rem; line-height: 1.8; max-width: 620px; margin-bottom: 0.5rem">
                B.Eng. IoT System and Information Engineering — หลักสูตรปรับปรุง พ.ศ. 2565 และ 2569
            </p>
            <p style="color: rgba(255, 255, 255, 0.55); font-size: 0.9rem; margin-bottom: 2rem">
                คณะวิศวกรรมศาสตร์ · ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ · สจล. ลาดกระบัง
            </p>
            <div class="mb-6 gap-4 flex flex-wrap">
                @foreach ([['144', 'Total Credits'], ['4', 'Years'], ['8', 'Semesters'], ['25,000 ฿', 'Per Semester']] as $stat)
                    <div
                        style="
                            background: rgba(255, 255, 255, 0.07);
                            border: 1px solid rgba(255, 255, 255, 0.12);
                            padding: 1rem 1.5rem;
                            border-radius: 10px;
                            color: #fff;
                            text-align: center;
                        "
                    >
                        <div class="text-2xl font-black" style="font-family: 'Playfair Display', serif">{{ $stat[0] }}</div>
                        <div class="mt-1 text-xs opacity-60">{{ $stat[1] }}</div>
                    </div>
                @endforeach
            </div>
            <div class="gap-3 flex flex-wrap">
                <a
                    href="https://docs.google.com/viewerng/viewer?url=http://www.iote.kmitl.ac.th/wp-content/uploads/2024/07/%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5%E0%B8%AA%E0%B8%A3%E0%B8%B8%E0%B8%9B-%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%81%E0%B8%AA%E0%B8%B9%E0%B8%95%E0%B8%A3IoT.pdf"
                    target="_blank"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                        background: var(--crimson);
                        color: #fff;
                        padding: 0.6rem 1.4rem;
                        border-radius: 6px;
                        font-size: 0.875rem;
                        font-weight: 600;
                        text-decoration: none;
                    "
                >
                    View Official Curriculum ↗
                </a>
                <a
                    href="{{ route('admission.index') }}"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                        background: rgba(255, 255, 255, 0.1);
                        border: 1px solid rgba(255, 255, 255, 0.25);
                        color: #fff;
                        padding: 0.6rem 1.4rem;
                        border-radius: 6px;
                        font-size: 0.875rem;
                        font-weight: 600;
                        text-decoration: none;
                    "
                >
                    Admission Info
                </a>
            </div>
        </div>
    </section>

    <!-- PROGRAMME OVERVIEW BANNER -->
    <section style="background: var(--crimson); padding: 2rem 0">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="gap-8 flex flex-wrap items-center justify-between">
                <div style="color: #fff">
                    <div
                        style="font-size: 0.75rem; letter-spacing: 0.12em; opacity: 0.75; text-transform: uppercase; margin-bottom: 0.25rem"
                    >
                        Programme
                    </div>
                    <div style="font-weight: 700; font-size: 1rem">วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ (ภาษาไทย ปกติ)</div>
                </div>
                <div style="color: #fff">
                    <div
                        style="font-size: 0.75rem; letter-spacing: 0.12em; opacity: 0.75; text-transform: uppercase; margin-bottom: 0.25rem"
                    >
                        Campus
                    </div>
                    <div style="font-weight: 700">ลาดกระบัง · E-12</div>
                </div>
                <div style="color: #fff">
                    <div
                        style="font-size: 0.75rem; letter-spacing: 0.12em; opacity: 0.75; text-transform: uppercase; margin-bottom: 0.25rem"
                    >
                        Seats
                    </div>
                    <div style="font-weight: 700">95 ที่นั่ง/ปี</div>
                </div>
                <div style="color: #fff">
                    <div
                        style="font-size: 0.75rem; letter-spacing: 0.12em; opacity: 0.75; text-transform: uppercase; margin-bottom: 0.25rem"
                    >
                        Tuition
                    </div>
                    <div style="font-weight: 700">25,000 ฿/ภาค</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CREDIT SUMMARY -->
    <section style="background: var(--light); padding: 3.5rem 0; border-bottom: 1px solid var(--border)">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="rounded-2xl p-6" style="background: #fff; border: 1px solid var(--border)">
                <h3 class="mb-3 text-lg font-bold" style="font-family: 'Playfair Display', serif; color: var(--dark)">เกี่ยวกับหลักสูตร</h3>
                <p class="mb-4 text-sm leading-relaxed" style="color: var(--muted)">
                    หลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ บูรณาการความรู้หลายด้าน ได้แก่ สมาร์ทเซ็นเซอร์ การสื่อสารและเครือข่าย
                    คอมพิวเตอร์และการพัฒนาซอฟต์แวร์ วิทยาการข้อมูลและปัญญาประดิษฐ์ เพื่อผลิตวิศวกรที่ออกแบบสร้างนวัตกรรมระบบ IoT ได้จริง
                    ตอบสนองนโยบาย Thailand 4.0 และอุตสาหกรรม S-Curve
                </p>
                <div class="gap-3 flex flex-wrap">
                    <a
                        href="https://www.iote.kmitl.ac.th/bachelor-of-engineering-iot-system-and-information/"
                        target="_blank"
                        class="btn-primary"
                        style="font-size: 0.875rem; padding: 0.6rem 1.25rem"
                    >
                        หลักสูตรปรับปรุง 2565 ↗
                    </a>
                    <a
                        href="https://www.iote.kmitl.ac.th/%e0%b8%a7%e0%b8%a8-%e0%b8%9a-%e0%b8%aa%e0%b8%b2%e0%b8%82%e0%b8%b2%e0%b8%a7%e0%b8%b4%e0%b8%a8%e0%b8%a7%e0%b8%81%e0%b8%a3%e0%b8%a3%e0%b8%a1%e0%b9%84%e0%b8%ad%e0%b9%82%e0%b8%ad%e0%b8%97%e0%b8%b5%e0%b9%81/"
                        target="_blank"
                        class="btn-outline"
                        style="font-size: 0.875rem; padding: 0.6rem 1.25rem"
                    >
                        หลักสูตรปรับปรุง 2569 ↗
                    </a>
                    <a
                        href="https://drive.google.com/file/d/1cHSWjO3A03lcGqgbT9PR51d335LfaVVo/view"
                        target="_blank"
                        class="btn-outline"
                        style="font-size: 0.875rem; padding: 0.6rem 1.25rem"
                    >
                        Dual Degree PhysIoT ↗
                    </a>
                    <a
                        href="https://www.iote.kmitl.ac.th/%e0%b8%a7%e0%b8%a8-%e0%b8%9a-%e0%b8%a7%e0%b8%b4%e0%b8%a8%e0%b8%a7%e0%b8%81%e0%b8%a3%e0%b8%a3%e0%b8%a1%e0%b8%84%e0%b8%ad%e0%b8%a1%e0%b8%9e%e0%b8%b4%e0%b8%a7%e0%b9%80%e0%b8%95%e0%b8%ad%e0%b8%a3/"
                        target="_blank"
                        class="btn-outline"
                        style="font-size: 0.875rem; padding: 0.6rem 1.25rem"
                    >
                        หลักศูตรต่อเนื่อง ↗
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 4rem 0; background: #fff; border-bottom: 1px solid var(--border)">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="mb-10 text-center">
                <span class="section-label">Programme Types</span>
                <h2 class="section-title">เลือกหลักสูตรที่สนใจ</h2>
                <div class="accent-line mt-4 mx-auto"></div>
            </div>

            <div class="gap-6 flex flex-wrap justify-center">
                {{-- Card: Dual Degree --}}
                <a href="{{ route('syllabus.dual') }}" class="programme-card">
                    <div class="card-icon">⚡</div>
                    <div>Dual Degree</div>
                    <div class="card-subtitle">
                        (B.Eng. IoT System and Information
                        <br />
                        + B.Sc. Industrial Physics)
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- YEAR TABS -->
    <section style="padding: 5rem 0; background: #fff">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="mb-10 text-center">
                <span class="section-label">Course Structure</span>
                <h2 class="section-title">4-Year Course Plan</h2>
                <p style="color: var(--muted); font-size: 0.875rem; margin-top: 0.5rem">
                    วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ (ฉบับปรับปรุง พ.ศ. 2569) · 138 หน่วยกิต
                </p>
                <div class="accent-line mt-4 mx-auto"></div>
            </div>

            <!-- Year selector -->
            <div class="mb-10 gap-3 flex flex-wrap justify-center">
                <button class="year-tab active" data-year="1">Year 1</button>
                <button class="year-tab" data-year="2">Year 2</button>
                <button class="year-tab" data-year="3">Year 3</button>
                <button class="year-tab" data-year="4">Year 4</button>
            </div>

            @php
                $allCourses = [
                    1 => [
                        1 => [
                            // Semester 1
                            ['01006030', 'Calculus 1', 3, 'core'],
                            ['01006020', 'General Physics 1', 3, 'core'],
                            ['01006021', 'General Physics Lab 1', 1, 'lab'],
                            ['01236604', 'Circuit Electronics', 3, 'core'],
                            ['01006012', 'Computer Programming', 3, 'core'],
                            ['01236611', 'Introduction to IoT', 3, 'core'],
                            ['01236605', 'Circuit Electronics Lab', 1, 'lab'],
                            ['01236610', '3D Drawing', 1, 'core'],
                            ['90641008', 'Introductory English', 0, 'gen'],
                            ['90642036', 'Pre-Activities for Engineers', 1, 'gen'],
                            ['90641007', 'Digital Citizen', 3, 'gen'],
                        ],
                        2 => [
                            // Semester 2
                            ['01006031', 'Calculus 2', 3, 'core'],
                            ['01006022', 'General Physics 2', 3, 'core'],
                            ['01006023', 'General Physics Lab 2', 1, 'lab'],
                            ['01236251', 'Discrete Mathematics', 3, 'core'],
                            ['01236613', 'Object-Oriented Programming', 3, 'core'],
                            ['01236601', 'Probability and Statistics', 3, 'core'],
                            ['01236619', 'Interaction Design', 3, 'core'],
                            ['90642118', 'Application Software for Business', 2, 'gen'],
                            ['90641004', 'Team Project 1', 1, 'lab'],
                        ],
                    ],
                    2 => [
                        // Year 2
                        1 => [
                            // Semester 1
                            ['01236600', 'Differential Equations & Linear Algebra', 3, 'core'],
                            ['01236615', 'Principles of Communications', 3, 'core'],
                            ['01236603', 'Digital Systems', 3, 'core'],
                            ['01236609', 'Digital Lab', 1, 'lab'],
                            ['01236614', 'Data Structures', 3, 'core'],
                            ['01236626', 'System Analysis and Design', 3, 'core'],
                            ['90641009', 'Engineering English 1', 3, 'gen'],
                        ],
                        2 => [
                            // Semester 2
                            ['01236256', 'Cloud Lab', 1, 'lab'],
                            ['01236616', 'Data Communications', 3, 'core'],
                            ['01236618', 'Mobile App Development', 3, 'core'],
                            ['01236627', 'Computer Organization and OS', 3, 'core'],
                            ['01236630', 'Database Systems', 3, 'core'],
                            ['01236617', 'Sensor and Cyber-Physical Systems', 3, 'core'],
                            ['01236628', 'Cloud Lab 2', 1, 'lab'],
                            ['90641005', 'Team Project 2', 1, 'lab'],
                            ['90641010', 'Engineering English 2', 3, 'gen'],
                        ],
                    ],
                    3 => [
                        // Year 3
                        1 => [
                            // Semester 1
                            ['01236629', 'Wireless IoT', 3, 'core'],
                            ['01236622', 'Cyber Security', 3, 'core'],
                            ['01236621', 'AI for IoT', 3, 'core'],
                            ['01236625', 'Seminar', 0, 'core'],
                            ['01236623', 'IoT Lab 1', 1, 'lab'],
                            ['01236612', 'Microcontroller and Embedded Systems', 3, 'core'],
                            ['90644xxx', 'General Education — Language', 3, 'gen'],
                        ],
                        2 => [
                            // Semester 2
                            ['01236620', 'PLC and Industrial IoT', 3, 'core'],
                            ['0123xxxx', 'Major Elective 1', 3, 'elective'],
                            ['0123xxxx', 'Major Elective 2', 3, 'elective'],
                            ['01236267', 'IoT Lab 2', 1, 'lab'],
                            ['90xxxxxx', 'General Education 1', 3, 'gen'],
                            ['90xxxxxx', 'General Education 2', 3, 'gen'],
                            ['90641006', 'Team Project 3', 1, 'lab'],
                        ],
                        3 => [
                            // Semester 3 (ฝึกงาน)
                            ['01006004', 'Industrial Training', 0, 'core'],
                        ],
                    ],
                    4 => [
                        // Year 4
                        1 => [
                            // Semester 1 — Plan 1: Project
                            ['01236606', 'Project 1', 3, 'lab'],
                            ['0123xxxx', 'Elective 1', 3, 'elective'],
                            ['0123xxxx', 'Elective 2', 3, 'elective'],
                            ['xxxxxxx', 'Free Elective 1', 3, 'elective'],
                        ],
                        2 => [
                            // Semester 2 — Plan 1: Project
                            ['01236607', 'Project 2', 3, 'lab'],
                            ['0123xxxx', 'Elective 3', 3, 'elective'],
                            ['01236608', 'Capstone Project', 1, 'lab'],
                            ['xxxxxxx', 'Free Elective 2', 3, 'elective'],
                        ],
                    ],
                ];

                // Credit summary per type
                $creditSummary = ['core' => 0, 'lab' => 0, 'gen' => 0, 'elective' => 0];
                foreach ($allCourses as $yearData) {
                    foreach ($yearData as $semData) {
                        foreach ($semData as $c) {
                            $creditSummary[$c[3]] += $c[2];
                        }
                    }
                }

                $creditCards = [
                    ['label' => 'Core Credits', 'credits' => $creditSummary['core'], 'color' => 'var(--crimson)', 'sub' => 'วิชาบังคับ'],
                    ['label' => 'Elective Credits', 'credits' => $creditSummary['elective'], 'color' => 'var(--orange)', 'sub' => 'วิชาเลือก'],
                    ['label' => 'Gen Ed Credits', 'credits' => $creditSummary['gen'], 'color' => 'var(--muted)', 'sub' => 'วิชาศึกษาทั่วไป'],
                    ['label' => 'Lab/Project Credits', 'credits' => $creditSummary['lab'], 'color' => '#167b00', 'sub' => 'ปฏิบัติการ/โครงงาน'],
                ];

                $typeLabels = ['core' => 'CORE', 'elective' => 'ELEC', 'gen' => 'GEN', 'lab' => 'LAB'];
            @endphp

            <!-- Credit summary cards -->
            <div class="mb-8 gap-6 md:grid-cols-4 grid grid-cols-2">
                @foreach ($creditCards as $data)
                    <div
                        style="
                            background: #fff;
                            border: 1px solid var(--border);
                            border-radius: 12px;
                            padding: 1.5rem;
                            border-top: 4px solid {{ $data['color'] }};
                        "
                    >
                        <div class="mb-1 text-3xl font-black" style="color: {{ $data['color'] }}; font-family: 'Playfair Display', serif">
                            {{ $data['credits'] }}
                        </div>
                        <div class="text-sm font-medium" style="color: var(--dark)">{{ $data['label'] }}</div>
                        <div class="mt-1 text-xs" style="color: var(--muted)">{{ $data['sub'] }}</div>
                    </div>
                @endforeach
            </div>

            <!-- LEGEND -->
            <div class="mb-6 gap-3 text-xs font-semibold flex flex-wrap">
                <span>
                    <span class="credit-badge type-core" style="padding: 0.2rem 0.6rem">CORE</span>
                    Core Engineering
                </span>
                <span>
                    <span class="credit-badge type-elective" style="padding: 0.2rem 0.6rem">ELEC</span>
                    Elective
                </span>
                <span>
                    <span class="credit-badge type-gen" style="padding: 0.2rem 0.6rem">GEN</span>
                    General Education
                </span>
                <span>
                    <span class="credit-badge type-lab" style="padding: 0.2rem 0.6rem">LAB</span>
                    Laboratory / Project
                </span>
            </div>

            <!-- Course header -->
            <div
                class="course-row mb-2"
                style="
                    background: var(--dark);
                    border-radius: 10px;
                    color: #fff;
                    font-size: 0.8125rem;
                    font-weight: 600;
                    letter-spacing: 0.04em;
                "
            >
                <span>Course Code</span>
                <span>Course Name</span>
                <span>Credits</span>
                <span>Type</span>
            </div>

            <!-- Year content blocks -->
            @foreach ($allCourses as $year => $yearSemesters)
                <div class="year-content {{ $loop->first ? 'active' : '' }}" id="year-{{ $year }}">
                    @foreach ($yearSemesters as $semester => $semesterCourses)
                        @php
                            $semTotal = array_sum(array_column($semesterCourses, 2));
                            $semLabel = $semester === 3 ? 'Summer — Industrial Training' : "Year {$year} — Semester {$semester}";
                        @endphp

                        <div class="semester-block">
                            <div
                                class="semester-header"
                                onclick="
                                    this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? '' : 'none'
                                "
                            >
                                <div class="gap-3 flex items-center">
                                    <span class="font-bold" style="color: var(--dark)">{{ $semLabel }}</span>
                                    @if ($semTotal > 0)
                                        <span class="text-sm" style="color: var(--muted)">{{ $semTotal }} credits</span>
                                    @endif
                                </div>
                                <svg class="h-5 w-5" style="color: var(--muted)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div class="semester-body">
                                @foreach ($semesterCourses as $course)
                                    <div class="course-row">
                                        <span class="font-mono text-sm font-semibold" style="color: var(--crimson)">{{ $course[0] }}</span>
                                        <span class="text-sm font-medium" style="color: var(--dark)">{{ $course[1] }}</span>
                                        <span class="course-credit text-sm font-bold text-center" style="color: var(--dark)">
                                            {{ $course[2] > 0 ? $course[2] : '—' }}
                                        </span>
                                        <span>
                                            <span class="credit-badge type-{{ $course[3] }}">
                                                {{ $typeLabels[$course[3]] ?? strtoupper($course[3]) }}
                                            </span>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <p class="mt-4 text-xs text-center" style="color: var(--muted)">
                * Plan 2 (Co-op / Study Abroad) ปี 4 เทอม 1 จะแทนที่ด้วยวิชา Co-operative Education (6 หน่วยกิต) ·
                <a
                    href="https://www.iote.kmitl.ac.th/%e0%b8%a7%e0%b8%a8-%e0%b8%9a-%e0%b8%aa%e0%b8%b2%e0%b8%82%e0%b8%b2%e0%b8%a7%e0%b8%b4%e0%b8%a8%e0%b8%a7%e0%b8%81%e0%b8%a3%e0%b8%a3%e0%b8%a1%e0%b9%84%e0%b8%ad%e0%b9%82%e0%b8%ad%e0%b8%97%e0%b8%b5%e0%b9%81/"
                    target="_blank"
                    style="color: var(--crimson)"
                >
                    ดูหลักสูตรฉบับเต็ม ↗
                </a>
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.year-tab').forEach((btn) => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.year-tab').forEach((b) => b.classList.remove('active'));
                document.querySelectorAll('.year-content').forEach((c) => c.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('year-' + btn.dataset.year).classList.add('active');
            });
        });
    </script>
@endpush
