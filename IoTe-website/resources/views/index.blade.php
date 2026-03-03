@extends('layouts.app')
@section('title', 'IoTe KMITL — Department of IoT and Information Engineering')

@push('styles')
<style>
/* HERO CAROUSEL */
.hero-carousel { position: relative; height: 100vh; min-height: 600px; overflow: hidden; }
.hero-slide {
    position: absolute; inset: 0;
    opacity: 0; transition: opacity 1.2s ease;
    display: flex; align-items: center; justify-content: center;
}
.hero-slide.active { opacity: 1; }
.hero-slide::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(114,10,0,0.75) 0%, rgba(26,26,26,0.55) 100%);
}
.hero-slide-bg {
    position: absolute; inset: 0;
    background-size: cover; background-position: center;
    transform: scale(1.05); transition: transform 8s ease;
}
.hero-slide.active .hero-slide-bg { transform: scale(1); }
.hero-content { position: relative; z-index: 2; text-align: center; color: #fff; padding: 2rem; max-width: 820px; }
.hero-dept {
    font-size: 0.875rem; letter-spacing: 0.18em; text-transform: uppercase;
    color: rgba(255,200,150,0.9); font-weight: 600; margin-bottom: 1rem;
    opacity: 0; transform: translateY(20px); transition: all 0.8s 0.1s ease;
}
.hero-slide.active .hero-dept { opacity: 1; transform: translateY(0); }
.hero-content h1 {
    font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 6vw, 5rem);
    font-weight: 900; line-height: 1.1; margin-bottom: 1.25rem;
    opacity: 0; transform: translateY(30px); transition: all 0.8s 0.3s ease;
}
.hero-slide.active .hero-content h1 { opacity: 1; transform: translateY(0); }
.hero-content p {
    font-size: 1.125rem; font-weight: 300; line-height: 1.7;
    opacity: 0; transform: translateY(20px); transition: all 0.8s 0.5s ease;
    max-width: 560px; margin: 0 auto 2rem;
}
.hero-slide.active .hero-content p { opacity: 1; transform: translateY(0); }
.hero-btns { opacity: 0; transform: translateY(20px); transition: all 0.8s 0.7s ease; }
.hero-slide.active .hero-btns { opacity: 1; transform: translateY(0); }
.carousel-dots {
    position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
    display: flex; gap: 8px; z-index: 10;
}
.carousel-dot {
    width: 8px; height: 8px; border-radius: 4px;
    background: rgba(255,255,255,0.4); transition: all 0.3s; cursor: pointer;
}
.carousel-dot.active { width: 28px; background: #fff; }
.carousel-arrow {
    position: absolute; top: 50%; transform: translateY(-50%); z-index: 10;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.2); color: #fff;
    width: 48px; height: 48px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s;
}
.carousel-arrow:hover { background: var(--crimson); }
.carousel-prev { left: 1.5rem; } .carousel-next { right: 1.5rem; }

/* STATS */
.stat-card {
    text-align: center; padding: 2.5rem 1.5rem;
    background: linear-gradient(135deg, var(--crimson), var(--orange));
    border-radius: 16px; color: #fff; position: relative; overflow: hidden;
}
.stat-card::before {
    content: ''; position: absolute; width: 120px; height: 120px;
    background: rgba(255,255,255,0.06); border-radius: 50%; top: -30px; right: -30px;
}

/* PROGRAMS */
.program-card {
    border-radius: 16px; overflow: hidden; border: 1px solid var(--border);
    background: #fff; transition: all 0.3s; display: flex; flex-direction: column;
}
.program-card:hover { box-shadow: 0 20px 50px rgba(114,10,0,0.12); transform: translateY(-6px); }
.program-card-top {
    padding: 2rem;
    background: linear-gradient(135deg, var(--crimson), var(--orange));
    color: #fff; position: relative; overflow: hidden;
}
.program-card-top::before {
    content:''; position:absolute; width:160px; height:160px;
    background:rgba(255,255,255,0.06); border-radius:50%; top:-40px; right:-40px;
}

/* PROJECTS */
.project-card {
    border-radius: 14px; overflow: hidden; border: 1px solid var(--border);
    background: #fff; transition: all 0.3s;
}
.project-card:hover { box-shadow: 0 16px 40px rgba(114,10,0,0.12); transform: translateY(-5px); }
.project-img { height: 200px; overflow: hidden; }
.project-img img { width:100%; height:100%; object-fit:cover; transition: transform 0.6s; }
.project-card:hover .project-img img { transform: scale(1.06); }

/* CAREER */
.career-tag {
    display: inline-block; padding: 0.5rem 1rem; border-radius: 50px;
    font-size: 0.8rem; font-weight: 600;
    background: rgba(114,10,0,0.07); color: var(--crimson);
    border: 1px solid rgba(114,10,0,0.15); transition: all 0.2s;
}
.career-tag:hover { background: var(--crimson); color: #fff; }

/* GALLERY */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: 200px 200px;
    gap: 8px;
}
.gallery-item { overflow: hidden; border-radius: 8px; }
.gallery-item img { width:100%; height:100%; object-fit:cover; transition: transform 0.5s; }
.gallery-item:hover img { transform: scale(1.07); }
.gallery-item:first-child { grid-column: span 2; grid-row: span 2; }
</style>
@endpush

@section('content')

<!-- ═══ HERO CAROUSEL ═══ -->
<section class="hero-carousel" id="hero-carousel">
    <div class="hero-slide active">
        <div class="hero-slide-bg" style="background-image: url('http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/3.jpg');"></div>
        <div class="hero-content">
            <div class="hero-dept">ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ · KMITL</div>
            <h1>Department of<br><em style="color:#FFAA77;">IoT and Information</em><br>Engineering</h1>
            <p>Shaping the next generation of IoT engineers at King Mongkut's Institute of Technology Ladkrabang.</p>
            <div class="hero-btns flex flex-wrap gap-4 justify-center">
                <a href="{{ route('admission') }}" class="btn-primary">รับสมัครนักศึกษา 2569</a>
                <a href="{{ route('faculty') }}" style="border:2px solid rgba(255,255,255,0.6);color:#fff;display:inline-block;font-weight:600;padding:0.7rem 1.9rem;border-radius:6px;transition:all 0.2s;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='transparent'">Meet Faculty</a>
            </div>
        </div>
    </div>
    <div class="hero-slide">
        <div class="hero-slide-bg" style="background-image: url('http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/6.jpg');"></div>
        <div class="hero-content">
            <div class="hero-dept">Internet of Things · คณะวิศวกรรมศาสตร์ KMITL</div>
            <h1>Build Smart Systems.<br>Create <em style="color:#FFAA77;">Innovation.</em></h1>
            <p>From embedded systems and smart sensors to AI and data science — integrate it all with IoT engineering at KMITL.</p>
            <div class="hero-btns flex flex-wrap gap-4 justify-center">
                <a href="{{ route('syllabus') }}" class="btn-primary">View Curriculum</a>
                <a href="{{ route('laboratories.index') }}" style="border:2px solid rgba(255,255,255,0.6);color:#fff;display:inline-block;font-weight:600;padding:0.7rem 1.9rem;border-radius:6px;transition:all 0.2s;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='transparent'">Our Labs</a>
            </div>
        </div>
    </div>
    <div class="hero-slide">
        <div class="hero-slide-bg" style="background-image: url('http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/9.jpg');"></div>
        <div class="hero-content">
            <div class="hero-dept">Thailand 4.0 · S-Curve Industries Ready</div>
            <h1>The Secret<br>of <em style="color:#FFAA77;">Success</em></h1>
            <p>Aligned with Thailand's national development policy — producing graduates for smart electronics, digital industry, and EEC.</p>
            <div class="hero-btns flex flex-wrap gap-4 justify-center">
                <a href="{{ route('admission') }}" class="btn-primary">How to Apply</a>
                <a href="#programs" style="border:2px solid rgba(255,255,255,0.6);color:#fff;display:inline-block;font-weight:600;padding:0.7rem 1.9rem;border-radius:6px;transition:all 0.2s;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='transparent'">Our Programmes</a>
            </div>
        </div>
    </div>
    <button class="carousel-arrow carousel-prev" id="carousel-prev">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button class="carousel-arrow carousel-next" id="carousel-next">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
    <div class="carousel-dots">
        <div class="carousel-dot active" data-slide="0"></div>
        <div class="carousel-dot" data-slide="1"></div>
        <div class="carousel-dot" data-slide="2"></div>
    </div>
</section>


<!-- ═══ STATS BAR ═══ -->
<section style="background: var(--dark); padding: 4rem 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="stat-card">
                <div class="text-4xl font-black mb-1" style="font-family:'Playfair Display',serif;">95</div>
                <div class="text-sm font-medium opacity-80">Seats Per Year</div>
            </div>
            <div class="stat-card">
                <div class="text-4xl font-black mb-1" style="font-family:'Playfair Display',serif;">17+</div>
                <div class="text-sm font-medium opacity-80">Expert Faculty</div>
            </div>
            <div class="stat-card">
                <div class="text-4xl font-black mb-1" style="font-family:'Playfair Display',serif;">4</div>
                <div class="text-sm font-medium opacity-80">Degree Programmes</div>
            </div>
            <div class="stat-card">
                <div class="text-4xl font-black mb-1" style="font-family:'Playfair Display',serif;">50+</div>
                <div class="text-sm font-medium opacity-80">Years of Excellence</div>
            </div>
        </div>
    </div>
</section>


<!-- ═══ ABOUT SECTION ═══ -->
<section style="padding: 6rem 0; background: var(--light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="section-label">เกี่ยวกับเรา · About IoTE</span>
                <h2 class="section-title">IoT System &<br><em style="color:var(--crimson);">Information Engineering</em></h2>
                <div class="accent-line mt-4 mb-6"></div>
                <p class="leading-relaxed mb-5" style="color:var(--muted); font-size:1.05rem;">
                    ในโลกยุคดิจิทัล 4.0 ที่เทคโนโลยีต่าง ๆ เข้ามามีบทบาทสำคัญในชีวิตประจำวัน หลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศผลิตวิศวกรที่สามารถออกแบบสร้างนวัตกรรมด้านระบบ IoT และสารสนเทศได้อย่างครบวงจร
                </p>
                <p class="leading-relaxed mb-8" style="color:var(--muted);">
                    หลักสูตรนี้ตอบสนองนโยบายพัฒนาเศรษฐกิจแห่งชาติฉบับที่ 13 (พ.ศ. 2565–2569) รองรับอุตสาหกรรม S-Curve ทั้งอิเล็กทรอนิกส์อัจฉริยะ ดิจิทัล และการพัฒนาเขต EEC
                </p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach([
                        ['💻', 'Software & Hardware', 'การพัฒนาซอฟต์แวร์และอุปกรณ์อิเล็กทรอนิกส์อัจฉริยะ'],
                        ['📡', 'Communication & Network', 'ระบบสื่อสาร เครือข่าย และ IoT Connectivity'],
                        ['🤖', 'AI & Data Science', 'ปัญญาประดิษฐ์ วิทยาการข้อมูล และการวิเคราะห์ข้อมูล'],
                        ['🔒', 'Cybersecurity', 'ความมั่นคงสารสนเทศ และการป้องกันระบบ']
                    ] as [$icon, $title, $desc])
                    <div class="p-4 rounded-xl" style="background:#fff; border:1px solid var(--border);">
                        <div class="text-2xl mb-2">{{ $icon }}</div>
                        <div class="font-semibold text-sm mb-1" style="color:var(--dark);">{{ $title }}</div>
                        <div class="text-xs leading-relaxed" style="color:var(--muted);">{{ $desc }}</div>
                    </div>
                    @endforeach
                </div>
                <a href="https://www.iote.kmitl.ac.th/about-iote/" target="_blank" class="btn-outline">Read More About IoTE ↗</a>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/1.jpg" alt="IoTe Lab" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/4.jpg" alt="IoTe Workshop" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/14.jpg" alt="IoTe Event" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/8.jpg" alt="IoTe Project" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/11.jpg" alt="IoTe Students" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══ PROGRAMMES ═══ -->
<section id="programs" style="padding: 6rem 0; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="section-label">Academics · หลักสูตรที่เปิดสอน</span>
            <h2 class="section-title">Our Degree Programmes</h2>
            <div class="accent-line mx-auto mt-4"></div>
            <p class="mt-4 text-lg max-w-2xl mx-auto" style="color:var(--muted);">เรียน 4 ปี ได้วุฒิปริญญาตรี พร้อมโอกาสสองปริญญาในโครงการ Dual Degree และต่อยอดปริญญาโท-เอก</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="program-card">
                <div class="program-card-top">
                    <div style="font-size:2.5rem; margin-bottom:0.75rem;">🎓</div>
                    <div style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;opacity:0.8;margin-bottom:0.5rem;">Bachelor of Engineering</div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;line-height:1.3;margin-bottom:0.5rem;">B.Eng. IoT System and Information Engineering</h3>
                    <p style="font-size:0.875rem;opacity:0.85;">วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ</p>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">หลักสูตร 4 ปี บูรณาการความรู้ด้านซอฟต์แวร์ ฮาร์ดแวร์ IoT การสื่อสาร และปัญญาประดิษฐ์ เพื่อผลิตวิศวกรพร้อมทำงานในอุตสาหกรรมยุคดิจิทัล 4.0</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(['IoT Systems','Embedded','Software Dev','Data Science','Cybersecurity'] as $tag)
                        <span class="tag" style="font-size:0.75rem;">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-auto pt-4 border-t" style="border-color:var(--border);">
                        <div class="flex justify-between text-sm">
                            <span style="color:var(--muted);">Duration: <strong style="color:var(--dark);">4 Years</strong></span>
                            <span style="color:var(--muted);">Tuition: <strong style="color:var(--crimson);">25,000 ฿/sem</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="program-card">
                <div class="program-card-top" style="background:linear-gradient(135deg,#1a1a2e,#720a00);">
                    <div style="font-size:2.5rem; margin-bottom:0.75rem;">🔬</div>
                    <div style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;opacity:0.8;margin-bottom:0.5rem;">Dual Degree · ครั้งแรกในไทย</div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;line-height:1.3;margin-bottom:0.5rem;">B.Eng. IoT + B.Sc. Industrial Physics</h3>
                    <p style="font-size:0.875rem;opacity:0.85;">วศ.บ. IoT + วท.บ. ฟิสิกส์อุตสาหกรรม — "PhysIoT"</p>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">โครงการ "PhysIoT" — ครั้งแรกในประเทศไทย! เรียน 4 ปี ได้ 2 ปริญญา ทลายกำแพงระหว่างคณะวิศวกรรมศาสตร์และคณะวิทยาศาสตร์ สจล.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(['2 Degrees / 4 Years','Smart Sensors','Physics + IoT','Innovation'] as $tag)
                        <span class="tag" style="font-size:0.75rem;">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-auto pt-4 border-t" style="border-color:var(--border);">
                        <div class="flex justify-between text-sm">
                            <span style="color:var(--muted);">Duration: <strong style="color:var(--dark);">4 Years</strong></span>
                            <span style="color:var(--muted);"><strong style="color:var(--crimson);">Eng + Sci Faculty</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="program-card">
                <div class="program-card-top" style="background:linear-gradient(135deg,var(--orange),#c44a00);">
                    <div style="font-size:2.5rem; margin-bottom:0.75rem;">⚙️</div>
                    <div style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;opacity:0.8;margin-bottom:0.5rem;">Continuing Programme · ต่อเนื่อง</div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;line-height:1.3;margin-bottom:0.5rem;">B.Eng. Computer and IoT Engineering</h3>
                    <p style="font-size:0.875rem;opacity:0.85;">วศ.บ. วิศวกรรมคอมพิวเตอร์และไอโอที (ต่อเนื่อง)</p>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">สำหรับผู้จบ ปวส. สายช่างหรือคอมพิวเตอร์ ต่อยอดการศึกษาสู่ปริญญาตรีในสาขาวิศวกรรมคอมพิวเตอร์และไอโอที</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(['ปวส. → ปริญญาตรี','Computer Eng','IoT','Continuing'] as $tag)
                        <span class="tag" style="font-size:0.75rem;">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-auto pt-4 border-t" style="border-color:var(--border);">
                        <span style="color:var(--muted);font-size:0.875rem;">For: <strong style="color:var(--dark);">ปวส. graduates</strong></span>
                    </div>
                </div>
            </div>

            <div class="program-card">
                <div class="program-card-top" style="background:linear-gradient(135deg,#2d1b4e,#720a00);">
                    <div style="font-size:2.5rem; margin-bottom:0.75rem;">🎖️</div>
                    <div style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;opacity:0.8;margin-bottom:0.5rem;">Graduate Studies · บัณฑิตศึกษา</div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;line-height:1.3;margin-bottom:0.5rem;">M.Eng. &amp; Ph.D. — AIoT and Information</h3>
                    <p style="font-size:0.875rem;opacity:0.85;">วศ.ม. และ ปร.ด. วิศวกรรมเอไอโอทีและสารสนเทศ</p>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">หลักสูตรปริญญาโทและปริญญาเอกด้าน AIoT (AI + IoT) สำหรับผู้ต้องการต่อยอดการวิจัยและนวัตกรรมในระดับสูง</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(['M.Eng','Ph.D','AIoT','Research','Innovation'] as $tag)
                        <span class="tag" style="font-size:0.75rem;">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-auto pt-4 border-t" style="border-color:var(--border);">
                        <span style="color:var(--muted);font-size:0.875rem;">Graduate Level <strong style="color:var(--crimson);">Research Programme</strong></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ═══ STUDENT PROJECTS ═══ -->
<section style="padding: 6rem 0; background: var(--light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="section-label">MORE FROM THE IoT COMMUNITY · ผลงานนักศึกษา</span>
            <h2 class="section-title">Student Projects &<br><em style="color:var(--crimson);">Innovations</em></h2>
            <div class="accent-line mx-auto mt-4"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $projects = [
                ['img'=>'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/4.jpg','title'=>'Measurement Multimeter','desc'=>'อุปกรณ์วัดค่าที่สามารถวัดได้หลากหลาย ตั้งแต่อุณหภูมิไปจนถึงปริมาณแก๊ส LPG ในรูปแบบที่ไม่เหมือนใคร','tag'=>'Smart Sensors','url'=>'https://www.iote.kmitl.ac.th/measurement-multimeter/'],
                ['img'=>'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/8.jpg','title'=>'Safety Cap','desc'=>'หมวกพร้อมเซนเซอร์ตรวจจับความเร่ง 3 แกน และชุดหลอดไฟ LED เพื่อความปลอดภัยบนท้องถนน','tag'=>'Wearable IoT','url'=>'https://www.iote.kmitl.ac.th/safety-cap/'],
                ['img'=>'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/11.jpg','title'=>'Automatic Blending Machine','desc'=>'เครื่องดื่มของคุณจะคงความอร่อยได้ทุกครั้ง ทุกที่ ทุกเวลา ด้วยระบบ IoT อัตโนมัติ','tag'=>'Automation','url'=>'https://www.iote.kmitl.ac.th/automatic-blending-machine/'],
                ['img'=>'http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/14.jpg','title'=>'Smart Waste Bin · ถังวัดปริมาณ','desc'=>'ถังขยะอัจฉริยะที่แจ้งเตือนเมื่อถึงเวลาที่ควรเทขยะ ก่อนที่มันจะเต็มกว่านี้!','tag'=>'Smart City','url'=>'https://www.iote.kmitl.ac.th/'],
            ];
            @endphp
            @foreach($projects as $p)
            <a href="{{ $p['url'] }}" target="_blank" class="project-card" style="text-decoration:none;color:inherit;">
                <div class="project-img"><img src="{{ $p['img'] }}" alt="{{ $p['title'] }}" loading="lazy"></div>
                <div class="p-5">
                    <span class="tag" style="font-size:0.7rem;margin-bottom:0.75rem;display:inline-block;">{{ $p['tag'] }}</span>
                    <h3 class="font-bold mb-2 leading-tight" style="font-family:'Playfair Display',serif;color:var(--dark);font-size:1rem;">{{ $p['title'] }}</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--muted);">{{ $p['desc'] }}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="https://www.iote.kmitl.ac.th/" target="_blank" class="btn-outline">View More Projects ↗</a>
        </div>
    </div>
</section>


<!-- ═══ CAREER PATHS ═══ -->
<section style="padding: 6rem 0; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="section-label">After Graduation · อาชีพหลังจบ</span>
                <h2 class="section-title">Career<br><em style="color:var(--crimson);">Opportunities</em></h2>
                <div class="accent-line mt-4 mb-6"></div>
                <p class="leading-relaxed mb-8" style="color:var(--muted);">
                    บัณฑิตจากหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศสามารถประกอบอาชีพได้หลากหลายในอุตสาหกรรมดิจิทัล ซึ่งรัฐบาลให้การสนับสนุนและมีความต้องการสูงอย่างต่อเนื่อง
                </p>
                <div class="flex flex-wrap gap-3">
                    @foreach(['IoT Engineer','Information System Engineer','Embedded System Engineer','Embedded Software Engineer','Application Developer','Programmer','Software Engineer','Front End Developer','Back End Developer','Full Stack Developer','Cloud Engineer','Network Engineer','Data Scientist','Data Engineer','System Administrator','Cybersecurity Specialist','นักวิจัย / Researcher','เจ้าของธุรกิจ Startup'] as $career)
                    <span class="career-tag">{{ $career }}</span>
                    @endforeach
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden" style="box-shadow: 0 20px 60px rgba(114,10,0,0.15);">
                <img src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/02/cropped-2.jpg" alt="IoTe Graduate Careers" style="width:100%;height:420px;object-fit:cover;" loading="lazy"
                     onerror="this.src='http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/3.jpg'">
            </div>
        </div>
    </div>
</section>


<!-- ═══ KEY HIGHLIGHTS ═══ -->
<section style="padding: 6rem 0; background: var(--light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="section-label">Why IoTE KMITL</span>
            <h2 class="section-title">จุดเด่นของภาควิชา</h2>
            <div class="accent-line mx-auto mt-4"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $highlights = [
                ['🏆','กิจกรรมโดดเด่น','ภาควิชาจัดกิจกรรมพิเศษตลอดปี เช่น ค่ายมัธยมและเวิร์กช็อปพัฒนาทักษะ IoT ให้นักศึกษาลงมือสร้างนวัตกรรมจริง'],
                ['👨‍🏫','อาจารย์ผู้เชี่ยวชาญ','ทีมอาจารย์ผู้เชี่ยวชาญในหลากหลายสาขา ตั้งแต่ IoT, Embedded Systems, Cybersecurity, Data Mining ไปจนถึง Railway Engineering'],
                ['🌐','โอกาสที่ไม่สิ้นสุด','เครือข่ายของเราเปิดโอกาสทั้งด้านการศึกษา วิจัย และฝึกงานในอุตสาหกรรมจริง พร้อมรองรับ EEC และ Thailand 4.0'],
                ['🔬','Cybersecurity Laboratory','ห้องปฏิบัติการ Cybersecurity ชั้นนำ มีงานวิจัยระดับแนวหน้าที่ได้รับการยอมรับ พร้อมนักวิจัยเชี่ยวชาญ'],
                ['🎓','Dual Degree ครั้งแรกในไทย','โครงการ "PhysIoT" หลักสูตรสองปริญญาครั้งแรกในประเทศไทย เรียน 4 ปี ได้ 2 ปริญญา จากสองคณะ'],
                ['🚀','โครงการเด่น','นักศึกษามีส่วนร่วมในโครงการขับเคลื่อนนวัตกรรมจริง เช่น ระบบอัจฉริยะสำหรับเกษตรกรรม Smart City และอุตสาหกรรม'],
            ];
            @endphp
            @foreach($highlights as [$icon, $title, $desc])
            <div class="p-8 rounded-2xl bg-white" style="border:1px solid var(--border);transition:all 0.3s;" onmouseover="this.style.boxShadow='0 16px 40px rgba(114,10,0,0.1)';this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)'">
                <div class="text-4xl mb-4">{{ $icon }}</div>
                <h3 class="font-bold text-lg mb-3" style="font-family:'Playfair Display',serif;color:var(--dark);">{{ $title }}</h3>
                <p class="text-sm leading-relaxed" style="color:var(--muted);">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ═══ CTA BANNER ═══ -->
<section style="background:linear-gradient(135deg,var(--crimson),var(--orange));padding:5rem 0;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:url('http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/6.jpg') center/cover;opacity:0.08;"></div>
    <div class="max-w-4xl mx-auto px-4 text-center" style="position:relative;z-index:1;">
        <h2 style="font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:900;color:#fff;margin-bottom:1rem;">รับสมัครนักศึกษาประจำปี 2569</h2>
        <p style="color:rgba(255,255,255,0.85);font-size:1.125rem;max-width:600px;margin:0 auto 0.75rem;">วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ · 95 ที่นั่ง</p>
        <p style="color:rgba(255,255,255,0.7);font-size:0.9rem;max-width:500px;margin:0 auto 2.5rem;">Portfolio (75 ที่นั่ง) · Quota (15 ที่นั่ง) · Admission (5 ที่นั่ง)</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('admission') }}" style="background:#fff;color:var(--crimson);font-weight:700;padding:0.85rem 2.25rem;border-radius:6px;text-decoration:none;font-size:1rem;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">ดูรายละเอียดการรับสมัคร</a>
            <a href="http://admission.reg.kmitl.ac.th/" target="_blank" style="border:2px solid rgba(255,255,255,0.7);color:#fff;font-weight:600;padding:0.8rem 2rem;border-radius:6px;text-decoration:none;font-size:1rem;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='transparent'">สมัครที่นี่ ↗</a>
        </div>
        <p class="mt-6 text-sm" style="color:rgba(255,255,255,0.6);">
            E-12 Building, KMITL Ladkrabang &nbsp;·&nbsp; iote@kmitl.ac.th
        </p>
    </div>
</section>

@endsection

@push('scripts')
<script>
const slides = document.querySelectorAll('.hero-slide');
const dots = document.querySelectorAll('.carousel-dot');
let current = 0, timer;
function goTo(n) {
    slides[current].classList.remove('active'); dots[current].classList.remove('active');
    current = (n + slides.length) % slides.length;
    slides[current].classList.add('active'); dots[current].classList.add('active');
}
function startAuto() { timer = setInterval(() => goTo(current + 1), 6000); }
function stopAuto() { clearInterval(timer); }
document.getElementById('carousel-prev').addEventListener('click', () => { stopAuto(); goTo(current - 1); startAuto(); });
document.getElementById('carousel-next').addEventListener('click', () => { stopAuto(); goTo(current + 1); startAuto(); });
dots.forEach(dot => dot.addEventListener('click', () => { stopAuto(); goTo(+dot.dataset.slide); startAuto(); }));
startAuto();
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
    });
});
</script>
@endpush