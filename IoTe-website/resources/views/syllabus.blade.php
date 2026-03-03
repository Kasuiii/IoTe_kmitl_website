@extends('layouts.app')
@section('title', 'Course Syllabus — IoTe KMITL')

@push('styles')
<style>
.year-tab {
    padding: 0.75rem 1.75rem;
    border-radius: 8px;
    font-weight: 600; font-size: 0.875rem;
    cursor: pointer; border: 2px solid var(--border);
    background: #fff; color: var(--muted);
    transition: all 0.2s;
}
.year-tab.active, .year-tab:hover {
    border-color: var(--crimson); color: var(--crimson);
    background: rgba(114,10,0,0.05);
}
.year-tab.active { background: var(--crimson); color: #fff; border-color: var(--crimson); }
.year-content { display: none; }
.year-content.active { display: block; }
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
.course-row:hover { background: var(--light); border-color: var(--border); }
@media (max-width:640px) {
    .course-row { grid-template-columns: 1fr 1fr; }
    .course-row .course-credit, .course-row .course-type { font-size:0.75rem; }
}
.semester-block {
    border-radius: 16px;
    border: 1px solid var(--border);
    overflow: hidden;
    margin-bottom: 2rem;
}
.semester-header {
    padding: 1rem 1.5rem;
    display: flex; justify-content: space-between; align-items: center;
    cursor: pointer;
    background: var(--light);
    transition: background 0.2s;
}
.semester-header:hover { background: #EDE8E6; }
.semester-body { padding: 0 1rem 1rem; }
.credit-badge {
    display: inline-block;
    font-size: 0.75rem; font-weight: 700;
    padding: 0.2rem 0.6rem;
    border-radius: 5px;
    background: rgba(114,10,0,0.08);
    color: var(--crimson);
}
.type-core { background: rgba(114,10,0,0.1); color: var(--crimson); }
.type-elective { background: rgba(227,82,5,0.1); color: var(--orange); }
.type-gen { background: rgba(107,99,96,0.1); color: var(--muted); }
.type-lab { background: rgba(22,123,0,0.1); color: #167B00; }
</style>
@endpush

@section('content')

<!-- HERO -->
<section style="background: var(--dark); padding: 7rem 0 5rem; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background: radial-gradient(ellipse at 70% 50%, rgba(114,10,0,0.4), transparent 70%);"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative;">
        <span class="section-label" style="color:rgba(255,163,107,0.9);">หลักสูตรวิศวกรรมศาสตรบัณฑิต · B.Eng Curriculum</span>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.5rem,5vw,4rem); font-weight:900; color:#fff; line-height:1.1; max-width:780px; margin-bottom:1.25rem;">
            วศ.บ. วิศวกรรมระบบไอโอที<br>และสารสนเทศ &amp;<br><em style="color:#FFAA77;">Programme Structure</em>
        </h1>
        <p style="color:rgba(255,255,255,0.75); font-size:1.125rem; line-height:1.8; max-width:620px; margin-bottom:0.5rem;">
            B.Eng. IoT System and Information Engineering — หลักสูตรปรับปรุง พ.ศ. 2565 และ 2569
        </p>
        <p style="color:rgba(255,255,255,0.55); font-size:0.9rem; margin-bottom:2rem;">
            คณะวิศวกรรมศาสตร์ · ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ · สจล. ลาดกระบัง
        </p>
        <div class="flex flex-wrap gap-4 mb-6">
            @foreach([['144', 'Total Credits'], ['4', 'Years'], ['8', 'Semesters'], ['25,000 ฿', 'Per Semester']] as $stat)
            <div style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); padding:1rem 1.5rem; border-radius:10px; color:#fff; text-align:center;">
                <div class="font-black text-2xl" style="font-family:'Playfair Display',serif;">{{ $stat[0] }}</div>
                <div class="text-xs opacity-60 mt-1">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="https://docs.google.com/viewerng/viewer?url=http://www.iote.kmitl.ac.th/wp-content/uploads/2024/07/%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5%E0%B8%AA%E0%B8%A3%E0%B8%B8%E0%B8%9B-%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%81%E0%B8%AA%E0%B8%B9%E0%B8%95%E0%B8%A3IoT.pdf" target="_blank" style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--crimson);color:#fff;padding:0.6rem 1.4rem;border-radius:6px;font-size:0.875rem;font-weight:600;text-decoration:none;">
                View Official Curriculum ↗
            </a>
            <a href="{{ route('admission') }}" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.25);color:#fff;padding:0.6rem 1.4rem;border-radius:6px;font-size:0.875rem;font-weight:600;text-decoration:none;">
                Admission Info
            </a>
        </div>
    </div>
</section>

<!-- PROGRAMME OVERVIEW BANNER -->
<section style="background:var(--crimson); padding:2rem 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap gap-8 items-center justify-between">
            <div style="color:#fff;">
                <div style="font-size:0.75rem;letter-spacing:0.12em;opacity:0.75;text-transform:uppercase;margin-bottom:0.25rem;">Programme</div>
                <div style="font-weight:700;font-size:1rem;">วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ (ภาษาไทย ปกติ)</div>
            </div>
            <div style="color:#fff;">
                <div style="font-size:0.75rem;letter-spacing:0.12em;opacity:0.75;text-transform:uppercase;margin-bottom:0.25rem;">Campus</div>
                <div style="font-weight:700;">ลาดกระบัง · E-12</div>
            </div>
            <div style="color:#fff;">
                <div style="font-size:0.75rem;letter-spacing:0.12em;opacity:0.75;text-transform:uppercase;margin-bottom:0.25rem;">Seats</div>
                <div style="font-weight:700;">95 ที่นั่ง/ปี</div>
            </div>
            <div style="color:#fff;">
                <div style="font-size:0.75rem;letter-spacing:0.12em;opacity:0.75;text-transform:uppercase;margin-bottom:0.25rem;">Tuition</div>
                <div style="font-weight:700;">25,000 ฿/ภาค</div>
            </div>
        </div>
    </div>
</section>

<!-- CREDIT SUMMARY -->
<section style="background:var(--light); padding:3.5rem 0; border-bottom:1px solid var(--border);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="p-6 rounded-2xl" style="background:#fff; border:1px solid var(--border);">
            <h3 class="font-bold text-lg mb-3" style="font-family:'Playfair Display',serif; color:var(--dark);">เกี่ยวกับหลักสูตร</h3>
            <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">
                หลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ บูรณาการความรู้หลายด้าน ได้แก่ สมาร์ทเซ็นเซอร์ การสื่อสารและเครือข่าย คอมพิวเตอร์และการพัฒนาซอฟต์แวร์ วิทยาการข้อมูลและปัญญาประดิษฐ์ เพื่อผลิตวิศวกรที่ออกแบบสร้างนวัตกรรมระบบ IoT ได้จริง ตอบสนองนโยบาย Thailand 4.0 และอุตสาหกรรม S-Curve
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="https://www.iote.kmitl.ac.th/bachelor-of-engineering-iot-system-and-information/" target="_blank" class="btn-primary" style="font-size:0.875rem;padding:0.6rem 1.25rem;">หลักสูตรปรับปรุง 2565 ↗</a>
                <a href="https://www.iote.kmitl.ac.th/%e0%b8%a7%e0%b8%a8-%e0%b8%9a-%e0%b8%aa%e0%b8%b2%e0%b8%82%e0%b8%b2%e0%b8%a7%e0%b8%b4%e0%b8%a8%e0%b8%a7%e0%b8%81%e0%b8%a3%e0%b8%a3%e0%b8%a1%e0%b9%84%e0%b8%ad%e0%b9%82%e0%b8%ad%e0%b8%97%e0%b8%b5%e0%b9%81/" target="_blank" class="btn-outline" style="font-size:0.875rem;padding:0.6rem 1.25rem;">หลักสูตรปรับปรุง 2569 ↗</a>
                <a href="https://drive.google.com/file/d/1cHSWjO3A03lcGqgbT9PR51d335LfaVVo/view" target="_blank" class="btn-outline" style="font-size:0.875rem;padding:0.6rem 1.25rem;">Dual Degree PhysIoT ↗</a>
            </div>
        </div>
    </div>
</section>


<!-- YEAR TABS -->
<section style="padding: 5rem 0; background:#fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="section-label">Course Structure</span>
            <h2 class="section-title">4-Year Course Plan</h2>
            <div class="accent-line mx-auto mt-4"></div>
        </div>

        <!-- Year selector -->
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <button class="year-tab active" data-year="1">Year 1</button>
            <button class="year-tab" data-year="2">Year 2</button>
            <button class="year-tab" data-year="3">Year 3</button>
            <button class="year-tab" data-year="4">Year 4</button>
        </div>

        <!-- Credit summary -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
            @foreach([
                ['label' => 'วิชาการศึกษาทั่วไป', 'credits' => 30, 'color' => 'var(--muted)', 'sub' => 'General Education'],
                ['label' => 'วิชาเฉพาะ (Core)', 'credits' => 96, 'color' => 'var(--crimson)', 'sub' => 'Core Engineering'],
                ['label' => 'ปฏิบัติการ / โครงงาน', 'credits' => 24, 'color' => '#167B00', 'sub' => 'Lab & Projects'],
                ['label' => 'วิชาเลือกเสรี', 'credits' => 18, 'color' => 'var(--orange)', 'sub' => 'Free Electives'],
            ] as $cat)
            <div style="background:#fff; border:1px solid var(--border); border-radius:12px; padding:1.5rem; border-top:4px solid {{ $cat['color'] }};">
                <div class="font-black text-3xl mb-1" style="color:{{ $cat['color'] }}; font-family:'Playfair Display',serif;">{{ $cat['credits'] }}</div>
                <div class="text-sm font-medium" style="color:var(--dark);">{{ $cat['label'] }}</div>
                <div class="text-xs mt-1" style="color:var(--muted);">{{ $cat['sub'] }}</div>
            </div>
            @endforeach
        </div>
        
        <!-- LEGEND -->
        <div class="flex flex-wrap gap-3 mb-6 text-xs font-semibold">
            <span><span class="credit-badge type-core" style="padding:0.2rem 0.6rem;">CORE</span> Core Engineering</span>
            <span><span class="credit-badge type-elective" style="padding:0.2rem 0.6rem;">ELEC</span> Elective</span>
            <span><span class="credit-badge type-gen" style="padding:0.2rem 0.6rem;">GEN</span> General Education</span>
            <span><span class="credit-badge type-lab" style="padding:0.2rem 0.6rem;">LAB</span> Laboratory / Project</span>
        </div>

        <!-- Course header -->
        <div class="course-row mb-2" style="background:var(--dark); border-radius:10px; color:#fff; font-size:0.8125rem; font-weight:600; letter-spacing:0.04em;">
            <span>Course Code</span><span>Course Name</span><span>Credits</span><span>Type</span>
        </div>

        @php
        $curriculum = [
            1 => [
                ['sem' => 'Semester 1', 'total' => 20, 'courses' => [
                    ['code' => 'MTH 101', 'name' => 'Calculus I', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'PHY 101', 'name' => 'Physics I: Mechanics & Waves', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'PHY 101L', 'name' => 'Physics I Laboratory', 'credits' => 1, 'type' => 'lab'],
                    ['code' => 'CHM 101', 'name' => 'General Chemistry', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'ENG 101', 'name' => 'English for Engineers I', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'CPE 101', 'name' => 'Introduction to Programming', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'CPE 101L', 'name' => 'Programming Laboratory', 'credits' => 1, 'type' => 'lab'],
                    ['code' => 'SOC 101', 'name' => 'Thai Society & Culture', 'credits' => 3, 'type' => 'gen'],
                ]],
                ['sem' => 'Semester 2', 'total' => 19, 'courses' => [
                    ['code' => 'MTH 102', 'name' => 'Calculus II', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'PHY 102', 'name' => 'Physics II: Electricity & Magnetism', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'PHY 102L', 'name' => 'Physics II Laboratory', 'credits' => 1, 'type' => 'lab'],
                    ['code' => 'IOT 101', 'name' => 'Introduction to IoT Engineering', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'EEE 101', 'name' => 'Basic Electrical Engineering', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'ENG 102', 'name' => 'English for Engineers II', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'HUM 101', 'name' => 'Arts & Humanities', 'credits' => 3, 'type' => 'gen'],
                ]],
            ],
            2 => [
                ['sem' => 'Semester 1', 'total' => 19, 'courses' => [
                    ['code' => 'MTH 201', 'name' => 'Differential Equations', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'MTH 202', 'name' => 'Linear Algebra', 'credits' => 3, 'type' => 'gen'],
                    ['code' => 'CPE 201', 'name' => 'Data Structures & Algorithms', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'EEE 201', 'name' => 'Digital Electronics', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'EEE 201L', 'name' => 'Digital Electronics Laboratory', 'credits' => 1, 'type' => 'lab'],
                    ['code' => 'IOT 201', 'name' => 'Microcontroller Systems', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 201L', 'name' => 'Microcontroller Laboratory', 'credits' => 1, 'type' => 'lab'],
                ]],
                ['sem' => 'Semester 2', 'total' => 20, 'courses' => [
                    ['code' => 'CPE 202', 'name' => 'Operating Systems & Embedded Linux', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 202', 'name' => 'Wireless Sensor Networks', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 203', 'name' => 'Signal Processing for IoT', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'EEE 202', 'name' => 'Analog Circuits & PCB Design', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'EEE 202L', 'name' => 'PCB Design Laboratory', 'credits' => 1, 'type' => 'lab'],
                    ['code' => 'NET 201', 'name' => 'Computer Networks Fundamentals', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'HUM 201', 'name' => 'Professional Ethics in Engineering', 'credits' => 2, 'type' => 'gen'],
                ]],
            ],
            3 => [
                ['sem' => 'Semester 1', 'total' => 19, 'courses' => [
                    ['code' => 'IOT 301', 'name' => 'IoT Communication Protocols (MQTT/CoAP)', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 302', 'name' => 'Cloud & Edge Computing for IoT', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 303', 'name' => 'Machine Learning for Engineers', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'NET 301', 'name' => 'Network Security & Cryptography', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'CPE 301', 'name' => 'Real-Time Systems & RTOS', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 3E1', 'name' => 'Elective I (Smart Energy / Industrial IoT)', 'credits' => 3, 'type' => 'elective'],
                    ['code' => 'XXX 3E1', 'name' => 'Free Elective I', 'credits' => 1, 'type' => 'elective'],
                ]],
                ['sem' => 'Semester 2', 'total' => 19, 'courses' => [
                    ['code' => 'IOT 304', 'name' => 'Digital Twin & Industrial Automation', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 305', 'name' => 'Computer Vision for IoT', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 3E2', 'name' => 'Elective II (Smart City / Healthcare IoT)', 'credits' => 3, 'type' => 'elective'],
                    ['code' => 'IOT 3E3', 'name' => 'Elective III (Blockchain for IoT / AR)', 'credits' => 3, 'type' => 'elective'],
                    ['code' => 'IOT 399', 'name' => 'IoT System Design Project I', 'credits' => 3, 'type' => 'lab'],
                    ['code' => 'MGT 301', 'name' => 'Technology Management & Entrepreneurship', 'credits' => 2, 'type' => 'gen'],
                    ['code' => 'XXX 3E2', 'name' => 'Free Elective II', 'credits' => 2, 'type' => 'elective'],
                ]],
            ],
            4 => [
                ['sem' => 'Semester 1', 'total' => 16, 'courses' => [
                    ['code' => 'IOT 401', 'name' => 'IoT System Integration & Testing', 'credits' => 3, 'type' => 'core'],
                    ['code' => 'IOT 4E1', 'name' => 'Elective IV (Advanced Embedded AI)', 'credits' => 3, 'type' => 'elective'],
                    ['code' => 'IOT 499A', 'name' => 'Senior Capstone Project I', 'credits' => 3, 'type' => 'lab'],
                    ['code' => 'INT 401', 'name' => 'Cooperative Education / Internship', 'credits' => 6, 'type' => 'lab'],
                    ['code' => 'XXX 4E1', 'name' => 'Free Elective III', 'credits' => 1, 'type' => 'elective'],
                ]],
                ['sem' => 'Semester 2', 'total' => 11, 'courses' => [
                    ['code' => 'IOT 499B', 'name' => 'Senior Capstone Project II (Final)', 'credits' => 6, 'type' => 'lab'],
                    ['code' => 'IOT 4E2', 'name' => 'Elective V (Industry-Specific Application)', 'credits' => 3, 'type' => 'elective'],
                    ['code' => 'ENG 401', 'name' => 'Technical Communication & Thesis Writing', 'credits' => 2, 'type' => 'gen'],
                ]],
            ],
        ];
        $typeLabels = ['core' => 'CORE', 'elective' => 'ELEC', 'gen' => 'GEN', 'lab' => 'LAB'];
        @endphp

        @foreach($curriculum as $year => $semesters)
        <div class="year-content {{ $year == 1 ? 'active' : '' }}" id="year-{{ $year }}">
            <div class="space-y-0">
                @foreach($semesters as $semester)
                <div class="semester-block">
                    <div class="semester-header" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? '' : 'none'">
                        <div class="flex items-center gap-3">
                            <span class="font-bold" style="color:var(--dark);">Year {{ $year }} — {{ $semester['sem'] }}</span>
                            <span class="text-sm" style="color:var(--muted);">{{ $semester['total'] }} credits</span>
                        </div>
                        <svg class="w-5 h-5" style="color:var(--muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <div class="semester-body">
                        @foreach($semester['courses'] as $course)
                        <div class="course-row">
                            <span class="text-sm font-mono font-semibold" style="color:var(--crimson);">{{ $course['code'] }}</span>
                            <span class="text-sm font-medium" style="color:var(--dark);">{{ $course['name'] }}</span>
                            <span class="course-credit text-sm font-bold text-center" style="color:var(--dark);">{{ $course['credits'] }}</span>
                            <span>
                                <span class="credit-badge type-{{ $course['type'] }}">{{ $typeLabels[$course['type']] }}</span>
                            </span>
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

@endsection

@push('scripts')
<script>
document.querySelectorAll('.year-tab').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.year-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.year-content').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('year-' + btn.dataset.year).classList.add('active');
    });
});
</script>
@endpush