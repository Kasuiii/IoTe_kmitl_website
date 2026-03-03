@extends('layouts.app')
@section('title', 'Faculty — IoTe KMITL')

@push('styles')
<style>
.faculty-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.34,1.3,0.64,1);
}
.faculty-card:hover {
    box-shadow: 0 20px 48px rgba(114,10,0,0.12);
    transform: translateY(-8px);
}
.faculty-avatar {
    height: 180px;
    position: relative;
    overflow: hidden;
    background: var(--light);
    display: flex; align-items: center; justify-content: center;
}
.faculty-avatar img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s;
}
.faculty-card:hover .faculty-avatar img { transform: scale(1.06); }
.faculty-avatar-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(114,10,0,0.6) 0%, transparent 50%);
    opacity: 0; transition: opacity 0.3s;
    display: flex; align-items: flex-end; padding: 1rem;
}
.faculty-card:hover .faculty-avatar-overlay { opacity: 1; }
.social-link {
    width: 32px; height: 32px; border-radius: 8px;
    background: rgba(255,255,255,0.2); backdrop-filter: blur(4px);
    display: flex; align-items: center; justify-content: center;
    color: #fff; text-decoration: none;
    transition: background 0.2s;
}
.social-link:hover { background: var(--orange); }
.filter-btn {
    padding: 0.5rem 1.25rem;
    border-radius: 20px;
    font-size: 0.8125rem; font-weight: 600;
    cursor: pointer;
    border: 1px solid var(--border);
    background: #fff; color: var(--muted);
    transition: all 0.2s;
}
.filter-btn.active {
    background: var(--crimson); color: #fff; border-color: var(--crimson);
}
.filter-btn:hover:not(.active) { border-color: var(--crimson); color: var(--crimson); }
.faculty-item.hidden { display: none; }
.role-badge {
    display: inline-block;
    font-size: 0.65rem; font-weight: 700;
    padding: 0.15rem 0.55rem;
    border-radius: 4px;
    background: rgba(114,10,0,0.08);
    color: var(--crimson);
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}
.avatar-placeholder {
    width: 80px; height: 80px; border-radius: 50%;
    background: linear-gradient(135deg, var(--crimson), var(--orange));
    display: flex; align-items: center; justify-content: center;
    font-size: 1.75rem; font-weight: 900; color: #fff;
    font-family: 'Playfair Display', serif;
}
</style>
@endpush

@section('content')

<!-- HERO -->
<section style="background: linear-gradient(135deg, var(--dark), #2C1010); padding: 7rem 0 5rem; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background: radial-gradient(ellipse at 30% 60%, rgba(114,10,0,0.5), transparent 65%);"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative; z-index:1;">
        <div class="max-w-2xl">
            <span class="section-label" style="color:rgba(255,163,107,0.9);">Our People</span>
            <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.5rem,5vw,4rem); font-weight:900; color:#fff; line-height:1.1; margin-bottom:1.5rem;">
                Meet the<br><em style="color:#FFAA77;">Faculty</em>
            </h1>
            <p style="color:rgba(255,255,255,0.78); font-size:1.125rem; line-height:1.8;">
                คณาจารย์ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ — Department of IoT and Information Engineering, KMITL
            </p>
        </div>
        <div class="flex flex-wrap gap-6 mt-10">
            @foreach([['17+', 'Faculty Members'], ['3', 'Full Professors'], ['5', 'Assoc. Professors'], ['E-12', 'Building']] as $stat)
            <div style="text-align:center;">
                <div class="font-black text-3xl" style="font-family:'Playfair Display',serif; color:#fff;">{{ $stat[0] }}</div>
                <div class="text-sm mt-1" style="color:rgba(255,255,255,0.6);">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- FILTER BAR -->
<div style="background:var(--light); border-bottom:1px solid var(--border); padding:1rem 0; position:sticky; top:64px; z-index:40;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap gap-3 items-center">
        <span class="text-sm font-medium mr-1" style="color:var(--muted);">Filter by:</span>
        <button class="filter-btn active" data-filter="all">All Faculty</button>
        <button class="filter-btn" data-filter="professor">Professor / ศ.</button>
        <button class="filter-btn" data-filter="associate">Assoc. Prof. / รศ.</button>
        <button class="filter-btn" data-filter="assistant">Asst. Prof. / ผศ.</button>
        <button class="filter-btn" data-filter="lecturer">Lecturer / อาจารย์</button>
    </div>
</div>


<!-- DEPARTMENT HEAD HIGHLIGHT -->
<section style="padding: 5rem 0 0; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="section-label">Leadership</span>
        <h2 class="section-title mb-8" style="font-size:2rem;">Department Head</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16" style="background:var(--light); border-radius:24px; padding:3rem; border:1px solid var(--border);">
            <div class="flex gap-6 items-center">
                <div style="width:120px; height:120px; border-radius:20px; overflow:hidden; flex-shrink:0; border:3px solid var(--border);">
                    <img src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจแก้ว.jpg" alt="Asst.Prof.Dr.Pikulkaew Tangtisanon" style="width:100%;height:100%;object-fit:cover;">
                </div>
                <div>
                    <div class="tag mb-2">หัวหน้าภาควิชา · Department Head</div>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:700; color:var(--dark); margin-bottom:0.25rem;">Asst.Prof.Dr. Pikulkaew Tangtisanon</h3>
                    <p style="font-size:0.9rem; color:var(--crimson); font-weight:500;">ผศ.ดร.พิกุลแก้ว ตังติสานนท์</p>
                    <p class="text-sm mt-1" style="color:var(--muted);">pikulkaew.ta@kmitl.ac.th</p>
                </div>
            </div>
            <div>
                <h4 class="font-semibold mb-2" style="color:var(--dark);">Education</h4>
                <ul class="text-sm space-y-1 mb-4" style="color:var(--muted);">
                    <li>วศ.บ. วิศวกรรมสารสนเทศ — KMITL</li>
                    <li>วศ.ม. วิศวกรรมสารสนเทศ — KMITL</li>
                    <li>D.Eng. Science and Technology — Tokai University, Japan</li>
                </ul>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Web Application', 'Mobile Application', 'Information Security'] as $t)
                    <span class="tag" style="font-size:0.7rem;">{{ $t }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FULL FACULTY GRID -->
<section style="padding: 2rem 0 7rem; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="section-label">Full Faculty</span>
        <h2 class="section-title mb-3" style="font-size:2rem;">คณาจารย์ประจำภาควิชา</h2>
        <div class="accent-line mb-8"></div>

        @php
        $faculty = [
            // ─── Professors / ศ. ───
            [
                'en' => 'Prof.Dr. Apirat Siritaratiwat',
                'th' => 'ศ.ดร.อภิรัฐ ศิริธราธิวัตร',
                'rank' => 'professor',
                'rank_label' => 'Professor / ศ.',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายวิจัยและนวัตกรรม)',
                'email' => '—',
                'expertise' => ['Research & Innovation'],
                'img' => null,
            ],
            [
                'en' => 'Prof.Dr. Pitikhate Sooraksa',
                'th' => 'ศ.ดร.ปิติเขต สู้รักษา',
                'rank' => 'professor',
                'rank_label' => 'Professor / ศ.',
                'role' => 'อาจารย์ประจำหลักสูตร',
                'email' => 'pitikhate.so@kmitl.ac.th',
                'expertise' => ['IT Automation', 'Industrial Informatics'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจปิติเขต.jpg',
            ],
            // ─── Assoc. Professors / รศ. ───
            [
                'en' => 'Assoc.Prof.Dr. Boonchana Purahong',
                'th' => 'รศ.ดร.บุณย์ชนะ ภู่ระหงษ์',
                'rank' => 'associate',
                'rank_label' => 'Assoc. Prof. / รศ.',
                'role' => 'ประธานหลักสูตรฯ',
                'email' => 'boonchana.pu@kmitl.ac.th',
                'expertise' => ['Microprocessor', 'Microcontroller', 'Robotics', 'IoT & Smart System'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/kpboonch-251x300.jpg',
            ],
            [
                'en' => 'Assoc.Prof.Dr. Attasit Lasakul',
                'th' => 'รศ.ดร.อรรถสิทธิ์ หล่าสกุล',
                'rank' => 'associate',
                'rank_label' => 'Assoc. Prof. / รศ.',
                'role' => 'อาจารย์พิเศษ',
                'email' => 'attasit.la@kmitl.ac.th',
                'expertise' => ['Digital Processing', 'Image Watermarking', 'Embedded Systems', 'Machine Vision'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจอรรถ.jpg',
            ],
            // ─── Asst. Professors / ผศ. ───
            [
                'en' => 'Asst.Prof.Dr. Vanvisa Chutchavong',
                'th' => 'ผศ.ดร.วันวิสา ชัชวงษ์',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายการเงิน)',
                'email' => 'vanvisa.ch@kmitl.ac.th',
                'expertise' => ['Electronic', 'Bernstein Filter', 'Railway Signaling', 'Pattern Recognition'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจไก่.jpg',
            ],
            [
                'en' => 'Asst.Prof.Dr. Natchanai Roongmuanpha',
                'th' => 'ผศ.ดร.นัชนัยน์ รุ่งเหมือนฟ้า',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายต่างประเทศ)',
                'email' => 'natchanai.ro@kmitl.ac.th',
                'expertise' => ['Immittance Simulators', 'Active Analog Filters', 'Oscillator Design', 'Chaotic Circuits'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/07/อจโอม.jpg',
            ],
            [
                'en' => 'Asst.Prof.Dr. Kleddao Satcharoen',
                'th' => 'ผศ.ดร.เกล็ดดาว สัตย์เจริญ',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'อาจารย์ประจำภาควิชา',
                'email' => 'kleddao.sa@kmitl.ac.th',
                'expertise' => ['Human Computer Interaction', 'User Interfaces'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจฝน.jpg',
            ],
            [
                'en' => 'Asst.Prof. Nitjaree Satayarak',
                'th' => 'ผศ.นิจจารีย์ สัตยารักษ์',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายกิจการนักศึกษา)',
                'email' => 'nitjaree.sa@kmitl.ac.th',
                'expertise' => ['Software Engineering', 'Distributed Testing System'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจนิจ.jpg',
            ],
            [
                'en' => 'Asst.Prof.Dr. Thanavit Anuwongpinit',
                'th' => 'ผศ.ดร.ธนวิชญ์ อนุวงศ์พินิจ',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายวิชาการ)',
                'email' => 'thanavit.an@kmitl.ac.th',
                'expertise' => ['Internet of Things', 'Embedded Systems', 'Railway Signaling', 'Microprocessor'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/cropped-อจเหน่ง-2.jpg',
            ],
            [
                'en' => 'Asst.Prof.Dr. Auttapon Pomsathit',
                'th' => 'ผศ.ดร.อรรถพล ป้อมสถิตย์',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'อาจารย์ประจำหลักสูตร',
                'email' => 'auttapon.po@kmitl.ac.th',
                'expertise' => ['Cyber Security', 'Internetworking Design', 'Information Security'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/07/อจเป็ด.jpg',
            ],
            [
                'en' => 'Asst.Prof.Dr. Panarat Cherntanomwong',
                'th' => 'ผศ.ดร.พนารัตน์ เชิญถนอมวงศ์',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'อาจารย์ประจำหลักสูตร',
                'email' => 'panarat.ch@kmitl.ac.th',
                'expertise' => ['Telecommunication', 'Zigbee', 'Indoor Positioning'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจพนารัต.jpg',
            ],
            [
                'en' => 'Asst.Prof.Dr. Sutheera Puntheeranurak',
                'th' => 'ผศ.ดร.สุธีรา พันธ์ธีรานุรักษ์',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'อาจารย์ประจำหลักสูตร',
                'email' => 'sutheera.pu@kmitl.ac.th',
                'expertise' => ['Data Mining', 'Big Data'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจสุธีรา.jpg',
            ],
            [
                'en' => 'Asst.Prof. Sorapong Wachirarattanapornkul',
                'th' => 'ผศ.สรพงษ์ วชิรรัตนพรกุล',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'อาจารย์ผู้รับผิดชอบหลักสูตร',
                'email' => 'sorapong.wa@kmitl.ac.th',
                'expertise' => ['Analog & Digital Filter', 'Embedded System', 'RFID', 'Pattern Recognition'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจอัต.jpg',
            ],
            [
                'en' => 'Asst.Prof. Dolchai Sookcharoenphol',
                'th' => 'ผศ.ดลชัย สุขเจริญผล',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'อาจารย์ประจำหลักสูตร',
                'email' => 'dolchai.so@kmitl.ac.th',
                'expertise' => ['Digital Communications', 'Digital Signal Processing', 'Digital Audio Engineering'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจดล.png',
            ],
            [
                'en' => 'Asst.Prof. Paisan Sithiyopasakul',
                'th' => 'ผศ.ไพศาล สิทธิโยภาสกุล',
                'rank' => 'assistant',
                'rank_label' => 'Asst. Prof. / ผศ.',
                'role' => 'อาจารย์พิเศษ',
                'email' => 'paisan-si@kmitl.ac.th',
                'expertise' => ['Wireless Communication', 'Microprocessor Applications', 'Digital Filter'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/07/อจไพศาล.jpg',
            ],
            // ─── Lecturers / อาจารย์ ───
            [
                'en' => 'Dr. Suwilai Phumpho',
                'th' => 'ดร.สุวิไล พุ่มโพธิ์',
                'rank' => 'lecturer',
                'rank_label' => 'Lecturer / ดร.',
                'role' => 'รองหัวหน้าภาควิชา (ฝ่ายกิจการภายนอก)',
                'email' => 'suwilai.ph@kmitl.ac.th',
                'expertise' => ['Immittance Function Simulators'],
                'img' => 'http://www.iote.kmitl.ac.th/wp-content/uploads/2025/10/images.jpg',
            ],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="faculty-grid">
            @foreach($faculty as $member)
            <div class="faculty-card faculty-item" data-rank="{{ $member['rank'] }}">
                <div class="faculty-avatar">
                    @if($member['img'])
                        <img src="{{ $member['img'] }}" alt="{{ $member['en'] }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="avatar-placeholder" style="display:none; width:100%; height:100%; border-radius:0;">
                            {{ strtoupper(substr($member['en'], strpos($member['en'], ' ')+1, 1)) }}
                        </div>
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($member['en'], strpos($member['en'], ' ')+1, 1)) }}
                        </div>
                    @endif
                    <div class="faculty-avatar-overlay">
                        <div class="flex gap-2">
                            <a href="mailto:{{ $member['email'] }}" class="social-link" title="Email">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div style="padding: 1.25rem;">
                    <span class="role-badge">{{ $member['rank_label'] }}</span>
                    <h3 class="font-bold text-sm leading-tight mb-1" style="color:var(--dark); font-family:'Playfair Display',serif;">{{ $member['en'] }}</h3>
                    <p class="text-xs mb-1" style="color:var(--crimson); font-weight:500;">{{ $member['th'] }}</p>
                    <p class="text-xs mb-3" style="color:var(--muted); font-style:italic;">{{ $member['role'] }}</p>
                    <div class="flex flex-wrap gap-1">
                        @foreach(array_slice($member['expertise'], 0, 3) as $e)
                        <span style="font-size:0.62rem; background:var(--light); color:var(--muted); font-weight:500; padding:0.15rem 0.5rem; border-radius:4px;">{{ $e }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- STAFF -->
<section style="padding: 4rem 0 6rem; background: var(--light); border-top:1px solid var(--border);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="section-label">Department Staff</span>
        <h2 class="section-title mb-8" style="font-size:2rem;">บุคลากรภาควิชา</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach([
                ['name' => 'Mr. Thanat Jomjaiakchon (นายธนาตย์ จอมใจเอกชน)', 'role' => 'เจ้าหน้าที่วิศวกร'],
                ['name' => 'Mr. Teerasit Thotong (นายธีรสิทธิ์ โท้ทอง)', 'role' => 'เจ้าหน้าที่วิศวกร'],
            ] as $staff)
            <div style="background:#fff; border:1px solid var(--border); border-radius:12px; padding:1.25rem 1.5rem; display:flex; align-items:center; gap:1rem;">
                <div style="width:44px; height:44px; border-radius:10px; background:var(--light); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <svg class="w-5 h-5" style="color:var(--muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <div class="font-semibold text-sm" style="color:var(--dark);">{{ $staff['name'] }}</div>
                    <div class="text-xs mt-0.5" style="color:var(--muted);">{{ $staff['role'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CONTACT CTA -->
<section style="background: linear-gradient(135deg, var(--crimson), var(--orange)); padding:4rem 0;">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:900; color:#fff; margin-bottom:1rem;">ติดต่อภาควิชา</h2>
        <p style="color:rgba(255,255,255,0.85); margin-bottom:2rem;">ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ อาคาร E-12 สจล. ลาดกระบัง</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="mailto:iote@kmitl.ac.th" style="background:#fff; color:var(--crimson); font-weight:700; padding:0.75rem 2rem; border-radius:6px; text-decoration:none;">iote@kmitl.ac.th</a>
            <a href="https://www.iote.kmitl.ac.th" target="_blank" style="border:2px solid rgba(255,255,255,0.7); color:#fff; font-weight:600; padding:0.7rem 1.9rem; border-radius:6px; text-decoration:none;">Visit Official Site</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.faculty-item').forEach(item => {
            if (filter === 'all' || item.dataset.rank === filter) {
                item.classList.remove('hidden');
                item.style.display = '';
            } else {
                item.classList.add('hidden');
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endpush