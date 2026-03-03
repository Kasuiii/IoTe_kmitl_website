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
.round-card:hover { box-shadow: 0 12px 36px rgba(114,10,0,0.09); }
.round-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.25rem 1.75rem;
    cursor: pointer;
    transition: background 0.2s;
}
.round-1 .round-header { background: linear-gradient(135deg, var(--crimson), #A01200); color: #fff; }
.round-2 .round-header { background: linear-gradient(135deg, var(--orange), #C44600); color: #fff; }
.round-3 .round-header { background: linear-gradient(135deg, var(--dark), #3A2020); color: #fff; }
.round-body { padding: 1.5rem; background: #fff; }
.project-item {
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 1rem;
    transition: all 0.2s;
}
.project-item:last-child { margin-bottom: 0; }
.project-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1rem 1.25rem;
    background: var(--light);
    cursor: pointer;
    gap: 1rem;
}
.project-header:hover { background: #EDE8E6; }
.project-body {
    max-height: 0; overflow: hidden;
    transition: max-height 0.35s ease;
    padding: 0 1.25rem;
}
.project-item.open .project-body { max-height: 600px; padding: 1.25rem; }
.project-icon { transition: transform 0.3s; color: var(--crimson); flex-shrink: 0; }
.project-item.open .project-icon { transform: rotate(45deg); }
.req-bullet {
    display: flex; align-items: flex-start; gap: 0.625rem;
    font-size: 0.875rem; padding: 0.375rem 0;
    color: var(--dark);
}
.req-bullet::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--crimson);
    margin-top: 7px; flex-shrink: 0;
}
.seats-badge {
    background: var(--crimson);
    color: #fff;
    font-size: 0.75rem; font-weight: 700;
    padding: 0.2rem 0.75rem;
    border-radius: 20px;
    white-space: nowrap;
}
.score-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 0.875rem 1rem;
    border-radius: 8px;
    border: 1px solid var(--border);
}
.score-row:nth-child(odd) { background: var(--light); }
.score-bar {
    height: 6px; border-radius: 3px;
    background: linear-gradient(90deg, var(--crimson), var(--orange));
}
</style>
@endpush

@section('content')

<!-- HERO -->
<section style="background: linear-gradient(135deg, var(--crimson), #A01200); padding: 7rem 0 5rem; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1600') center/cover; opacity:0.07;"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative; z-index:1;">
        <span class="section-label" style="color:rgba(255,163,107,0.9);">Join IoTe KMITL</span>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.5rem,5vw,4rem); font-weight:900; color:#fff; line-height:1.1; max-width:700px; margin-bottom:1.5rem;">
            Admission<br><em style="color:#FFAA77;">2025 – 2026</em>
        </h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.125rem; line-height:1.8; max-width:560px; margin-bottom:2.5rem;">
            หลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ<br>
            <span style="font-size:0.95rem;">B.Eng. IoT System and Information Engineering — Ladkrabang Campus</span>
        </p>

        <!-- Seat summary cards -->
        <div class="flex flex-wrap gap-4">
            <div style="background:rgba(255,255,255,0.12); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.2); padding:1rem 1.75rem; border-radius:12px; color:#fff; text-align:center;">
                <div class="font-black text-3xl" style="font-family:'Playfair Display',serif;">75</div>
                <div class="text-xs opacity-75 mt-1">รอบ 1 Portfolio</div>
            </div>
            <div style="background:rgba(255,255,255,0.12); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.2); padding:1rem 1.75rem; border-radius:12px; color:#fff; text-align:center;">
                <div class="font-black text-3xl" style="font-family:'Playfair Display',serif;">15</div>
                <div class="text-xs opacity-75 mt-1">รอบ 2 Quota</div>
            </div>
            <div style="background:rgba(255,255,255,0.12); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.2); padding:1rem 1.75rem; border-radius:12px; color:#fff; text-align:center;">
                <div class="font-black text-3xl" style="font-family:'Playfair Display',serif;">5</div>
                <div class="text-xs opacity-75 mt-1">รอบ 3 Admission</div>
            </div>
            <div style="background:rgba(255,255,255,0.12); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.2); padding:1rem 1.75rem; border-radius:12px; color:#fff; text-align:center;">
                <div class="font-black text-3xl" style="font-family:'Playfair Display',serif;">25,000 ฿</div>
                <div class="text-xs opacity-75 mt-1">ค่าธรรมเนียม / ภาค</div>
            </div>
        </div>
    </div>
</section>


<!-- PROGRAMME DETAIL -->
<section style="background:var(--light); padding:3rem 0; border-bottom:1px solid var(--border);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
            @foreach([
                ['label' => 'ชื่อหลักสูตร', 'value' => 'วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ'],
                ['label' => 'English Name', 'value' => 'B.Eng. IoT System and Information Engineering'],
                ['label' => 'ประเภทหลักสูตร', 'value' => 'ภาษาไทย ปกติ'],
                ['label' => 'วิทยาเขต', 'value' => 'ลาดกระบัง (Ladkrabang)'],
            ] as $info)
            <div style="background:#fff; border:1px solid var(--border); border-radius:12px; padding:1.25rem;">
                <div class="text-xs font-semibold uppercase tracking-wider mb-1" style="color:var(--orange);">{{ $info['label'] }}</div>
                <div class="font-medium" style="color:var(--dark);">{{ $info['value'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ADMISSION ROUNDS -->
<section style="padding: 5rem 0; background: #fff;">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="section-label">TCAS Admission</span>
            <h2 class="section-title">รอบการรับสมัคร</h2>
            <div class="accent-line mx-auto mt-4"></div>
            <p class="mt-4" style="color:var(--muted);">คลิกที่แต่ละโครงการเพื่อดูรายละเอียดคุณสมบัติ</p>
        </div>

        <!-- ══ ROUND 1: PORTFOLIO ══ -->
        <div class="round-card round-1">
            <div class="round-header" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? '' : 'none'">
                <div class="flex items-center gap-4">
                    <div style="width:48px; height:48px; background:rgba(255,255,255,0.15); border-radius:12px; display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-weight:900; font-size:1.25rem;">1</div>
                    <div>
                        <div class="font-bold text-lg">รอบที่ 1 · PORTFOLIO</div>
                        <div style="font-size:0.8125rem; opacity:0.8;">7 โครงการ · รับรวม 75 คน</div>
                    </div>
                </div>
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>

            <div class="round-body">
                @php
                $round1 = [
                    [
                        'name' => 'โครงการ Young Engineering Talent',
                        'seats' => '30 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ / อาชีวะ',
                            'GPAX อย่างน้อย 5 ภาคการศึกษา ≥ 3.50',
                            'เคยได้รับรางวัลการแข่งขันระดับชาติหรือนานาชาติ ด้านคณิตศาสตร์–วิทยาศาสตร์–เทคโนโลยี อย่างน้อย 1 รายการ',
                            'ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา',
                        ],
                    ],
                    [
                        'name' => 'โครงการเรียนดี ช้างเผือก (สายสามัญ)',
                        'seats' => '30 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ',
                            'โรงเรียนเสนอชื่อนักเรียน GPAX สูงสุดอย่างน้อย 5 ภาคการศึกษา (ม.4–6)',
                        ],
                    ],
                    [
                        'name' => 'โครงการรางวัลและประกาศนียบัตรทางวิชาการ',
                        'seats' => '30 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ',
                            'GPAX อย่างน้อย 5 ภาคการศึกษา ≥ 3.00',
                            'มีผลงาน รางวัล หรือประกาศนียบัตร',
                        ],
                    ],
                    [
                        'name' => 'โครงการโรงเรียนวิทยาศาสตร์',
                        'seats' => '30 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ',
                            'GPAX อย่างน้อย 5 ภาคการศึกษา ≥ 3.00',
                            'กำลังศึกษา ม.6 สาย วิทย์–คณิต ในโรงเรียนวิทยาศาสตร์ หรือห้องเรียนพิเศษวิทยาศาสตร์–คณิตศาสตร์',
                        ],
                    ],
                    [
                        'name' => 'โครงการ Engineering Pathway',
                        'seats' => '30 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ / อาชีวะ',
                            'เคยเข้าร่วมโครงการ Pre-Engineering School ของคณะวิศวกรรมศาสตร์ สจล.',
                            'คะแนนเฉลี่ยสะสมจาก 6 วิชา ≥ 3.5',
                        ],
                    ],
                    [
                        'name' => 'โครงการ สอวน. (มูลนิธิโอลิมปิกวิชาการ)',
                        'seats' => '40 คน (รวมทุกหลักสูตร)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ',
                            'กำลังศึกษาหรือสำเร็จการศึกษา ม.6 สาย วิทย์–คณิต / ศิลป์–คำนวณ',
                            'GPAX อย่างน้อย 4 ภาคการศึกษา ≥ 2.75',
                            'ผ่านการอบรมค่าย 2 ของมูลนิธิ สอวน.',
                        ],
                    ],
                    [
                        'name' => 'โครงการบุตรของบุคลากร สจล.',
                        'seats' => '5 คน (รวมทุกหลักสูตร)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ',
                            'กำลังศึกษา ม.6 สาย วิทย์–คณิต',
                            'GPAX อย่างน้อย 5 ภาคการศึกษา ≥ 2.75',
                            'เป็นบุตรโดยชอบด้วยกฎหมายของพนักงาน/ข้าราชการ/ลูกจ้างประจำของ สจล. เท่านั้น',
                        ],
                    ],
                ];
                @endphp
                @foreach($round1 as $project)
                <div class="project-item">
                    <div class="project-header" onclick="this.closest('.project-item').classList.toggle('open')">
                        <div class="flex items-center gap-3 min-w-0">
                            <svg class="project-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span class="font-semibold text-sm truncate" style="color:var(--dark);">{{ $project['name'] }}</span>
                        </div>
                        <span class="seats-badge flex-shrink-0">{{ $project['seats'] }}</span>
                    </div>
                    <div class="project-body">
                        <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:var(--orange);">คุณสมบัติผู้สมัคร</p>
                        @foreach($project['reqs'] as $req)
                        <div class="req-bullet">{{ $req }}</div>
                        @endforeach
                        <a href="https://new.reg.kmitl.ac.th/admission/#/" target="_blank" class="inline-flex items-center gap-2 mt-4 text-sm font-semibold" style="color:var(--crimson);">
                            รายละเอียดเพิ่มเติม
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <!-- ══ ROUND 2: QUOTA ══ -->
        <div class="round-card round-2">
            <div class="round-header" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? '' : 'none'">
                <div class="flex items-center gap-4">
                    <div style="width:48px; height:48px; background:rgba(255,255,255,0.15); border-radius:12px; display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-weight:900; font-size:1.25rem;">2</div>
                    <div>
                        <div class="font-bold text-lg">รอบที่ 2 · QUOTA</div>
                        <div style="font-size:0.8125rem; opacity:0.8;">3 โครงการ · รับรวม 15 คน</div>
                    </div>
                </div>
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>

            <div class="round-body">
                @php
                $round2 = [
                    [
                        'name' => 'โควตาเรียนดี',
                        'seats' => '15 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ / อาชีวะ',
                            'GPAX อย่างน้อย 5 ภาคการศึกษา ≥ 3.00',
                        ],
                    ],
                    [
                        'name' => 'โควตากิจกรรม K-Engineering',
                        'seats' => '15 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ / อาชีวะ',
                            'GPAX อย่างน้อย 5 ภาคการศึกษา ≥ 2.75',
                            'ผ่านการเข้าร่วมกิจกรรมและได้รับประกาศนียบัตรในโครงการทางวิชาการกับคณะวิศวกรรมศาสตร์ สจล.',
                        ],
                    ],
                    [
                        'name' => 'โควตา KMITL One',
                        'seats' => '15 คน (รับร่วมกัน)',
                        'reqs' => [
                            'รับจากหลักสูตรแกนกลาง / นานาชาติ / อาชีวะ',
                            'GPAX 5 ภาคการศึกษา > 3.00 (หรือ > 2.75 สำหรับผู้สมัครโครงการ K-Engineering)',
                        ],
                    ],
                ];
                @endphp
                @foreach($round2 as $project)
                <div class="project-item">
                    <div class="project-header" onclick="this.closest('.project-item').classList.toggle('open')">
                        <div class="flex items-center gap-3 min-w-0">
                            <svg class="project-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span class="font-semibold text-sm truncate" style="color:var(--dark);">{{ $project['name'] }}</span>
                        </div>
                        <span class="seats-badge flex-shrink-0" style="background:var(--orange);">{{ $project['seats'] }}</span>
                    </div>
                    <div class="project-body">
                        <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:var(--orange);">คุณสมบัติผู้สมัคร</p>
                        @foreach($project['reqs'] as $req)
                        <div class="req-bullet">{{ $req }}</div>
                        @endforeach
                        <a href="https://new.reg.kmitl.ac.th/admission/#/" target="_blank" class="inline-flex items-center gap-2 mt-4 text-sm font-semibold" style="color:var(--crimson);">
                            รายละเอียดเพิ่มเติม
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <!-- ══ ROUND 3: ADMISSION ══ -->
        <div class="round-card round-3">
            <div class="round-header" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? '' : 'none'">
                <div class="flex items-center gap-4">
                    <div style="width:48px; height:48px; background:rgba(255,255,255,0.15); border-radius:12px; display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-weight:900; font-size:1.25rem;">3</div>
                    <div>
                        <div class="font-bold text-lg">รอบที่ 3 · ADMISSION</div>
                        <div style="font-size:0.8125rem; opacity:0.8;">ใช้คะแนน TGAT / TPAT3 / A-Level · รับ 5 คน</div>
                    </div>
                </div>
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>

            <div class="round-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-bold mb-3" style="color:var(--dark);">คุณสมบัติ</h4>
                        <div class="req-bullet">รับจากหลักสูตรแกนกลาง / นานาชาติ / อาชีวะ</div>
                        <div class="req-bullet">กำลังศึกษาหรือสำเร็จการศึกษา ม.ปลาย สาย วิทย์–คณิต หรือ ปวช. สายช่างอุตสาหกรรม</div>
                        <div class="req-bullet">มีคะแนน TGAT, TPAT3, A-Level Math 1 และ Physics</div>
                        <div class="mt-4 p-3 rounded-10" style="background:rgba(114,10,0,0.06); border-radius:10px;">
                            <span class="text-sm font-semibold" style="color:var(--crimson);">จำนวนที่เปิดรับ:</span>
                            <span class="text-sm ml-2" style="color:var(--dark);">5 คน</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold mb-3" style="color:var(--dark);">การคำนวณคะแนน</h4>
                        <div class="space-y-2">
                            @foreach([
                                ['subject' => 'TGAT (ความถนัดทั่วไป)', 'pct' => 20],
                                ['subject' => 'TPAT3 (วิทย์–เทค–วิศวะ)', 'pct' => 25],
                                ['subject' => 'A-Level คณิตศาสตร์ประยุกต์ 1', 'pct' => 25],
                                ['subject' => 'A-Level ฟิสิกส์', 'pct' => 30],
                            ] as $score)
                            <div class="score-row">
                                <span class="text-sm font-medium" style="color:var(--dark);">{{ $score['subject'] }}</span>
                                <div class="flex items-center gap-2">
                                    <div style="width:60px; height:6px; background:var(--border); border-radius:3px; overflow:hidden;">
                                        <div class="score-bar" style="width:{{ $score['pct'] * 2.5 }}px;"></div>
                                    </div>
                                    <span class="font-bold text-sm" style="color:var(--crimson); width:32px; text-align:right;">{{ $score['pct'] }}%</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a href="https://new.reg.kmitl.ac.th/admission/#/" target="_blank" class="btn-primary mt-4 text-sm inline-flex items-center gap-2">
                            สมัครผ่านระบบ KMITL
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- FEE INFO -->
<section style="padding: 5rem 0; background: var(--light);">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="section-label">ค่าใช้จ่าย</span>
            <h2 class="section-title" style="font-size:2rem;">Tuition Fees</h2>
            <div class="accent-line mx-auto mt-4"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div style="background:#fff; border:1px solid var(--border); border-top:4px solid var(--crimson); border-radius:14px; padding:2rem; text-align:center;">
                <div class="font-black text-3xl mb-2" style="font-family:'Playfair Display',serif; color:var(--crimson);">25,000 ฿</div>
                <div class="font-semibold mb-1" style="color:var(--dark);">ค่าธรรมเนียมการศึกษา</div>
                <div class="text-sm" style="color:var(--muted);">ต่อภาคการศึกษา</div>
            </div>
            <div style="background:#fff; border:1px solid var(--border); border-top:4px solid var(--orange); border-radius:14px; padding:2rem; text-align:center;">
                <div class="font-black text-3xl mb-2" style="font-family:'Playfair Display',serif; color:var(--orange);">200,000 ฿</div>
                <div class="font-semibold mb-1" style="color:var(--dark);">ค่าใช้จ่ายโดยประมาณ</div>
                <div class="text-sm" style="color:var(--muted);">ตลอดหลักสูตร 4 ปี</div>
            </div>
            <div style="background: linear-gradient(135deg, var(--crimson), var(--orange)); border-radius:14px; padding:2rem; text-align:center; color:#fff;">
                <div class="font-black text-2xl mb-2" style="font-family:'Playfair Display',serif;">กยศ / กรอ</div>
                <div class="font-semibold mb-1">กองทุนเงินให้กู้ยืม</div>
                <div class="text-sm opacity-85">สามารถขอกู้ยืมได้ตามเกณฑ์ของกองทุน</div>
            </div>
        </div>
    </div>
</section>


<!-- APPLY CTA -->
<section style="background: var(--dark); padding:5rem 0;">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 style="font-family:'Playfair Display',serif; font-size:2.25rem; font-weight:900; color:#fff; margin-bottom:1rem;">พร้อมสมัครแล้วหรือยัง?</h2>
        <p style="color:rgba(255,255,255,0.7); margin-bottom:2rem; font-size:1.0625rem;">ดูรายละเอียดทั้งหมดและสมัครผ่านระบบรับสมัครของ สจล. ได้เลย</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="https://new.reg.kmitl.ac.th/admission/#/" target="_blank" class="btn-primary text-base px-8 py-3">สมัครเรียน — KMITL Admission</a>
            <a href="{{ route('faculty') }}" class="btn-outline text-base px-8 py-3" style="border-color:rgba(255,255,255,0.4); color:#fff;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='transparent'">ดูคณาจารย์</a>
        </div>
    </div>
</section>

@endsection