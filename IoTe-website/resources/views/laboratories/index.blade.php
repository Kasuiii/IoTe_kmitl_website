@extends('layouts.app')
@section('title', 'Laboratories — IoTe KMITL')

@push('styles')
<style>
.lab-hero {
    background: linear-gradient(135deg, var(--crimson) 0%, var(--dark) 100%);
    padding: 7rem 0 5rem;
    position: relative; overflow: hidden;
}
.lab-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=1600') center/cover;
    opacity: 0.08;
}
.lab-card {
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid var(--border);
    background: #fff;
    transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
    display: flex; flex-direction: column;
}
.lab-card:hover { transform: translateY(-10px) scale(1.01); box-shadow: 0 24px 60px rgba(114,10,0,0.16); }
.lab-card-img { height: 260px; overflow: hidden; position: relative; }
.lab-card-img img { width:100%; height:100%; object-fit:cover; transition: transform 0.6s; }
.lab-card:hover .lab-card-img img { transform: scale(1.06); }
.lab-card-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(114,10,0,0.7) 0%, transparent 50%);
    opacity: 0; transition: opacity 0.35s;
}
.lab-card:hover .lab-card-img-overlay { opacity: 1; }
.lab-number {
    position: absolute; top: 1rem; left: 1rem;
    width: 44px; height: 44px;
    background: var(--crimson);
    color: #fff; font-weight: 900; font-size: 1.25rem;
    font-family: 'Playfair Display', serif;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    z-index: 2;
}
.lab-card-body { padding: 2rem; flex: 1; display: flex; flex-direction: column; }
.lab-arrow {
    margin-top: auto;
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.875rem; font-weight: 600;
    color: var(--crimson);
    text-decoration: none;
    transition: gap 0.2s, color 0.2s;
}
.lab-arrow:hover { gap: 14px; color: var(--orange); }

.feature-icon {
    width: 48px; height: 48px;
    background: rgba(114,10,0,0.08);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: var(--crimson);
    margin-bottom: 1rem;
}
</style>
@endpush

@section('content')

<!-- HERO -->
<section class="lab-hero">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="position:relative; z-index:1;">
        <div class="max-w-2xl">
            <span class="section-label" style="color:rgba(255,163,107,0.9);">Our Facilities</span>
            <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.5rem,5vw,4rem); font-weight:900; color:#fff; line-height:1.1; margin-bottom:1.5rem;">
                Research<br><em style="color:#FFAA77;">Laboratories</em>
            </h1>
            <p style="color:rgba(255,255,255,0.78); font-size:1.125rem; line-height:1.8; max-width:500px;">
                Three specialized laboratories where innovation happens every day — from embedded systems to intelligent networks and smart environmental engineering.
            </p>
        </div>
    </div>
</section>

<!-- BREADCRUMB -->
<div style="background:var(--light); border-bottom:1px solid var(--border); padding:0.875rem 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm" style="color:var(--muted);">
            <a href="{{ route('home') }}" class="hover:text-crimson transition-colors" style="color:inherit;">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span style="color:var(--crimson); font-weight:500;">Laboratories</span>
        </nav>
    </div>
</div>

<!-- LAB OVERVIEW INTRO -->
<section style="padding:5rem 0; background:#fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="section-label">World-Class Facilities</span>
        <h2 class="section-title">Explore Our Labs</h2>
        <div class="accent-line mx-auto mt-4"></div>
        <p class="mt-4 text-lg max-w-2xl mx-auto" style="color:var(--muted);">Each laboratory is equipped with industry-grade hardware and software to support cutting-edge research and hands-on student learning.</p>

        <!-- Feature highlights -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 text-left">
            @foreach([
                ['icon' => '🔬', 'title' => 'Industry-Grade Equipment', 'desc' => 'Funded by leading technology partners'],
                ['icon' => '🤝', 'title' => 'Open to Students', 'desc' => 'Access all year round for projects'],
                ['icon' => '📡', 'title' => 'Connected Infrastructure', 'desc' => '5G & private network testbeds'],
                ['icon' => '🏆', 'title' => 'Award-Winning Research', 'desc' => 'National & international recognition'],
            ] as $f)
            <div style="padding:1.75rem; border:1px solid var(--border); border-radius:14px; background:var(--light);">
                <div class="text-3xl mb-3">{{ $f['icon'] }}</div>
                <div class="font-semibold mb-1" style="color:var(--dark);">{{ $f['title'] }}</div>
                <div class="text-sm" style="color:var(--muted);">{{ $f['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- LAB CARDS -->
<section style="padding:2rem 0 7rem; background:var(--light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Lab 1 -->
            <div class="lab-card">
                <div class="lab-card-img">
                    <div class="lab-number">01</div>
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=800" alt="Lab rai wa">
                    <div class="lab-card-img-overlay"></div>
                </div>
                <div class="lab-card-body">
                    <span class="tag mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores quaerat corrupti error deleniti fugit ut modi neque incidunt! Nisi fuga facere unde quo cum odio id iste! Quos, corporis tempore.</span>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:700; color:var(--dark); margin-bottom:0.75rem;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum recusandae odio exercitationem dolor aut reprehenderit quis illo alias et aspernatur? Quidem explicabo, nesciunt dignissimos accusantium molestiae aliquam natus qui nulla?</h3>
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores illum ab quos, sapiente autem distinctio odit velit incidunt excepturi nobis error. Soluta esse minima possimus tempora, porro alias similique eligendi.</p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['FPGA', 'ARM Cortex', 'PCB Design', 'RTOS', 'Edge AI'] as $t)
                        <span class="tag" style="font-size:0.7rem;">{{ $t }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('laboratories.show', 1) }}" class="lab-arrow">
                        Explore This Lab
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Lab 2 -->
            <div class="lab-card">
                <div class="lab-card-img">
                    <div class="lab-number">02</div>
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800" alt="Network & Communications Lab">
                    <div class="lab-card-img-overlay"></div>
                </div>
                <div class="lab-card-body">
                    <span class="tag mb-3">Connectivity & Protocols</span>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:700; color:var(--dark); margin-bottom:0.75rem;">Lab rai wa</h3>
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod at nisi incidunt distinctio voluptate ullam, officiis voluptatem exercitationem possimus iusto ipsam reprehenderit vero, numquam repudiandae facere inventore, vitae consectetur accusantium?</p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['LoRaWAN', '5G/NB-IoT', 'Zigbee', 'MQTT', 'Network Security'] as $t)
                        <span class="tag" style="font-size:0.7rem;">{{ $t }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('laboratories.show', 2) }}" class="lab-arrow">
                        Explore This Lab
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Lab 3 -->
            <div class="lab-card">
                <div class="lab-card-img">
                    <div class="lab-number">03</div>
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800" alt="Smart Systems Lab">
                    <div class="lab-card-img-overlay"></div>
                </div>
                <div class="lab-card-body">
                    <span class="tag mb-3">Cyber security laboratory</span>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:700; color:var(--dark); margin-bottom:0.75rem;">Cyber Security Laboratory</h3>
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted);">Exploring network security, cryptography, secure communication protocols, and threat detection in IoT environments.</p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['TensorFlow Lite', 'Computer Vision', 'Predictive ML', 'Digital Twin', 'Smart Grid'] as $t)
                        <span class="tag" style="font-size:0.7rem;">{{ $t }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('laboratories.show', 3) }}" class="lab-arrow">
                        Explore This Lab
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection