@extends('layouts.app')
@section('title', $lab['name'] . ' — IoTe KMITL')

@push('styles')
    <style>
        .lab-hero-show {
            padding: 7rem 0 5rem;
            position: relative;
            overflow: hidden;
        }
        .lab-hero-show::before {
            content: '';
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            filter: brightness(0.25);
        }
        .equipment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1rem;
        }
        .equipment-item {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.875rem;
            transition: all 0.2s;
        }
        .equipment-item:hover {
            border-color: var(--orange);
            box-shadow: 0 4px 16px rgba(227, 82, 5, 0.1);
        }
        .equipment-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--crimson);
            flex-shrink: 0;
        }
        .research-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 2rem;
            transition: all 0.25s;
        }
        .research-card:hover {
            box-shadow: 0 10px 30px rgba(114, 10, 0, 0.09);
            transform: translateY(-3px);
        }
        .tab-btn {
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: transparent;
            transition: all 0.2s;
            color: var(--muted);
        }
        .tab-btn.active {
            background: var(--crimson);
            color: #fff;
        }
        .tab-btn:hover:not(.active) {
            background: var(--light);
            color: var(--dark);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="lab-hero-show" style="background: var(--dark)">
        <div
            style="
                position: absolute;
                inset: 0;
                background-image: url('{{ $lab['image'] }}');
                background-size: cover;
                background-position: center;
                filter: brightness(0.22);
            "
        ></div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" style="position: relative; z-index: 1">
            <!-- Breadcrumb -->
            <nav class="mb-6 flex items-center gap-2 text-sm" style="color: rgba(255, 255, 255, 0.55)">
                <a href="{{ route('home') }}" style="color:inherit; hover:color:#fff;">Home</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('laboratories.index') }}" style="color: inherit">Laboratories</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span style="color: rgba(255, 163, 107, 0.9)">{{ $lab['short'] }}</span>
            </nav>

            <div class="mb-4 flex items-center gap-4">
                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl text-xl font-black"
                    style="background: var(--crimson); font-family: 'Playfair Display', serif; color: #fff"
                >
                    {{ $lab['number'] }}
                </div>
                <span class="tag" style="background: rgba(227, 82, 5, 0.2); color: rgba(255, 163, 107, 0.9)">{{ $lab['category'] }}</span>
            </div>

            <h1
                style="
                    font-family: 'Playfair Display', serif;
                    font-size: clamp(2rem, 4.5vw, 3.5rem);
                    font-weight: 900;
                    color: #fff;
                    line-height: 1.15;
                    max-width: 700px;
                    margin-bottom: 1.25rem;
                "
            >
                {{ $lab['name'] }}
            </h1>
            <p style="color: rgba(255, 255, 255, 0.75); font-size: 1.125rem; line-height: 1.8; max-width: 580px; margin-bottom: 2rem">
                {{ $lab['description'] }}
            </p>
            <div class="flex flex-wrap gap-4">
                <div
                    style="
                        background: rgba(255, 255, 255, 0.1);
                        backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.15);
                        padding: 1rem 1.5rem;
                        border-radius: 12px;
                        color: #fff;
                        text-align: center;
                    "
                >
                    <div class="text-2xl font-black" style="font-family: 'Playfair Display', serif">{{ $lab['students'] }}+</div>
                    <div class="mt-1 text-xs opacity-70">Students / Year</div>
                </div>
                <div
                    style="
                        background: rgba(255, 255, 255, 0.1);
                        backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.15);
                        padding: 1rem 1.5rem;
                        border-radius: 12px;
                        color: #fff;
                        text-align: center;
                    "
                >
                    <div class="text-2xl font-black" style="font-family: 'Playfair Display', serif">{{ $lab['projects'] }}</div>
                    <div class="mt-1 text-xs opacity-70">Active Projects</div>
                </div>
                <div
                    style="
                        background: rgba(255, 255, 255, 0.1);
                        backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.15);
                        padding: 1rem 1.5rem;
                        border-radius: 12px;
                        color: #fff;
                        text-align: center;
                    "
                >
                    <div class="text-2xl font-black" style="font-family: 'Playfair Display', serif">{{ $lab['founded'] }}</div>
                    <div class="mt-1 text-xs opacity-70">Established</div>
                </div>
            </div>
        </div>
    </section>

    <!-- TABS NAV -->
    <div style="background: #fff; border-bottom: 1px solid var(--border); position: sticky; top: 64px; z-index: 40">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex gap-2 overflow-x-auto py-3">
                <button class="tab-btn active" data-tab="overview">Overview</button>
                <button class="tab-btn" data-tab="equipment">Equipment</button>
                <button class="tab-btn" data-tab="research">Research</button>
                <button class="tab-btn" data-tab="team">Team</button>
            </div>
        </div>
    </div>

    <!-- TAB CONTENTS -->
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <!-- OVERVIEW -->
        <div class="tab-content active" id="tab-overview">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
                <div class="space-y-8 lg:col-span-2">
                    <div>
                        <h2 class="section-title" style="font-size: 1.875rem">About This Lab</h2>
                        <div class="accent-line mt-3"></div>
                        <div class="mt-4 space-y-4 leading-relaxed" style="color: var(--muted)">
                            @foreach ($lab['about'] as $para)
                                <p>{{ $para }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-4 text-lg font-bold" style="color: var(--dark)">Key Focus Areas</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            @foreach ($lab['focus'] as $area)
                                <div
                                    style="
                                        padding: 1.25rem;
                                        border-left: 4px solid var(--crimson);
                                        background: var(--light);
                                        border-radius: 0 10px 10px 0;
                                    "
                                >
                                    <div class="mb-1 font-semibold" style="color: var(--dark)">{{ $area['title'] }}</div>
                                    <div class="text-sm" style="color: var(--muted)">{{ $area['desc'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div style="background: var(--light); border-radius: 14px; padding: 1.5rem; border: 1px solid var(--border)">
                        <h4 class="mb-4 font-bold" style="color: var(--dark)">Lab Information</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between">
                                <span style="color: var(--muted)">Head of Lab</span>
                                <span class="font-medium">{{ $lab['head'] }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span style="color: var(--muted)">Location</span>
                                <span class="font-medium">{{ $lab['location'] }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span style="color: var(--muted)">Capacity</span>
                                <span class="font-medium">{{ $lab['capacity'] }} students</span>
                            </li>
                            <li class="flex justify-between">
                                <span style="color: var(--muted)">Contact</span>
                                <span class="font-medium" style="color: var(--crimson)">{{ $lab['email'] }}</span>
                            </li>
                        </ul>
                    </div>
                    <div
                        style="
                            background: linear-gradient(135deg, var(--crimson), var(--orange));
                            border-radius: 14px;
                            padding: 1.75rem;
                            color: #fff;
                        "
                    >
                        <h4 class="mb-2 font-bold">Join This Lab</h4>
                        <p class="mb-4 text-sm leading-relaxed opacity-85">
                            Undergraduate and graduate students are welcome to apply for research positions and project work.
                        </p>
                        <a
                            href="{{ route('admission') }}"
                            style="
                                background: #fff;
                                color: var(--crimson);
                                font-weight: 600;
                                font-size: 0.875rem;
                                padding: 0.625rem 1.25rem;
                                border-radius: 6px;
                                text-decoration: none;
                                display: inline-block;
                                transition: all 0.2s;
                            "
                            onmouseover="this.style.transform = 'translateY(-1px)'"
                            onmouseout="this.style.transform = 'translateY(0)'"
                        >
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- EQUIPMENT -->
        <div class="tab-content" id="tab-equipment">
            <h2 class="section-title mb-2" style="font-size: 1.875rem">Equipment & Tools</h2>
            <div class="accent-line mb-8"></div>
            <div class="equipment-grid">
                @foreach ($lab['equipment'] as $eq)
                    <div class="equipment-item">
                        <div class="equipment-dot"></div>
                        <span class="text-sm font-medium" style="color: var(--dark)">{{ $eq }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- RESEARCH -->
        <div class="tab-content" id="tab-research">
            <h2 class="section-title mb-2" style="font-size: 1.875rem">Research Projects</h2>
            <div class="accent-line mb-8"></div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @foreach ($lab['research'] as $r)
                    <div class="research-card">
                        <span class="tag mb-3 inline-block">{{ $r['status'] }}</span>
                        <h3 class="mb-2 text-lg font-bold" style="font-family: 'Playfair Display', serif; color: var(--dark)">
                            {{ $r['title'] }}
                        </h3>
                        <p class="text-sm leading-relaxed" style="color: var(--muted)">{{ $r['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- TEAM -->
        <div class="tab-content" id="tab-team">
            <h2 class="section-title mb-2" style="font-size: 1.875rem">Lab Team</h2>
            <div class="accent-line mb-8"></div>
            <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                @foreach ($lab['team'] as $member)
                    <div class="text-center">
                        <div
                            class="mx-auto mb-3 h-20 w-20 overflow-hidden rounded-full"
                            style="background: var(--light); border: 3px solid var(--border)"
                        >
                            <div class="flex h-full w-full items-center justify-center text-2xl">{{ $member['avatar'] }}</div>
                        </div>
                        <div class="text-sm font-semibold" style="color: var(--dark)">{{ $member['name'] }}</div>
                        <div class="mt-1 text-xs" style="color: var(--muted)">{{ $member['role'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- BACK LINK -->
    <div class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <a
            href="{{ route('laboratories.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium"
            style="color: var(--crimson); text-decoration: none"
            onmouseover="this.style.color = 'var(--orange)'"
            onmouseout="this.style.color = 'var(--crimson)'"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to All Laboratories
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.tab-btn').forEach((btn) => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach((b) => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach((c) => c.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
            });
        });
    </script>
@endpush
