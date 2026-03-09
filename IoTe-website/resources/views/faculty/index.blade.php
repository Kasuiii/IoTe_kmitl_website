@extends('layouts.app')
@section('title', 'Faculty — IoTe KMITL')

@push('styles')
    <style>
        .faculty-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.34, 1.3, 0.64, 1);
        }
        .faculty-card:hover {
            box-shadow: 0 20px 48px rgba(114, 10, 0, 0.12);
            transform: translateY(-8px);
        }
        .faculty-avatar {
            height: 180px;
            position: relative;
            overflow: hidden;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .faculty-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .faculty-card:hover .faculty-avatar img {
            transform: scale(1.06);
        }
        .faculty-avatar-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(114, 10, 0, 0.6) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
        }
        .faculty-card:hover .faculty-avatar-overlay {
            opacity: 1;
        }
        .social-link {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: background 0.2s;
        }
        .social-link:hover {
            background: var(--orange);
        }
        .filter-btn {
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--muted);
            transition: all 0.2s;
        }
        .filter-btn.active {
            background: var(--crimson);
            color: #fff;
            border-color: var(--crimson);
        }
        .filter-btn:hover:not(.active) {
            border-color: var(--crimson);
            color: var(--crimson);
        }
        .faculty-item.hidden {
            display: none;
        }
        .role-badge {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.15rem 0.55rem;
            border-radius: 4px;
            background: rgba(114, 10, 0, 0.08);
            color: var(--crimson);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .avatar-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--crimson), var(--orange));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 900;
            color: #fff;
            font-family: 'Playfair Display', serif;
        }
        .faculty-popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .faculty-popup-card {
            background: white;
            border-radius: 14px;
            max-width: 650px;
            width: 90%;
            padding: 2rem;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        }

        .popup-close {
            position: absolute;
            top: 15px;
            right: 18px;
            font-size: 24px;
            border: none;
            background: none;
            cursor: pointer;
            color: var(--muted);
        }

        .popup-header {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .faculty-avatar.large {
            width: 110px;
            height: 110px;
        }

        .popup-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--dark);
        }

        .popup-th {
            color: var(--crimson);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .popup-role {
            color: var(--muted);
            font-style: italic;
            margin-bottom: 0.5rem;
        }

        .popup-email {
            font-size: 0.85rem;
            color: var(--crimson);
        }

        .popup-section h4 {
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .expertise-tag {
            font-size: 0.65rem;
            background: var(--light);
            color: var(--muted);
            font-weight: 500;
            padding: 0.2rem 0.55rem;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section style="background: linear-gradient(135deg, var(--dark), #2c1010); padding: 7rem 0 5rem; position: relative; overflow: hidden">
        <div
            {{-- style="position: absolute; inset: 0; background: radial-gradient(ellipse at 30% 60%, rgba(114, 10, 0, 0.5), transparent 65%)" --}}
            style="
                position: absolute;
                inset: 0;
                background: url('https://i.pinimg.com/736x/9a/9b/c1/9a9bc1e371ae7b3c08f6c2037fd70bbc.jpg') center/cover;
                opacity: 0.7;
            "
        ></div>
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <div class="max-w-2xl">
                <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Our People</span>
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
                    Meet the
                    <br />
                    <em style="color: #ffaa77">Faculty</em>
                </h1>
                <p style="color: rgba(255, 255, 255, 0.78); font-size: 1.125rem; line-height: 1.8">
                    คณาจารย์ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ — Department of IoT and Information Engineering, KMITL
                </p>
            </div>
            <div class="mt-10 gap-6 flex flex-wrap">
                @foreach ([['17+', 'Faculty Members'], ['3', 'Full Professors'], ['5', 'Assoc. Professors'], ['E-12', 'Building']] as $stat)
                    <div style="text-align: center">
                        <div class="text-3xl font-black" style="font-family: 'Playfair Display', serif; color: #fff">{{ $stat[0] }}</div>
                        <div class="mt-1 text-sm" style="color: rgba(255, 255, 255, 0.6)">{{ $stat[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FILTER BAR -->
    <div
        style="background: var(--light); border-bottom: 1px solid var(--border); padding: 1rem 0; position: sticky; top: 64px; z-index: 40"
    >
        <div class="max-w-7xl gap-3 px-4 sm:px-6 lg:px-8 mx-auto flex flex-wrap items-center">
            <span class="mr-1 text-sm font-medium" style="color: var(--muted)">Filter by:</span>
            <button class="filter-btn active" data-filter="all">All Faculty</button>
            <button class="filter-btn" data-filter="professor">Professor / ศ.</button>
            <button class="filter-btn" data-filter="assoc_prof">Assoc. Prof. / รศ.</button>
            <button class="filter-btn" data-filter="asst_prof">Asst. Prof. / ผศ.</button>
            <button class="filter-btn" data-filter="lecturer">Lecturer / อาจารย์</button>
        </div>
    </div>

    <!-- DEPARTMENT HEAD HIGHLIGHT -->
    <section style="padding: 5rem 0 0; background: #fff">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <span class="section-label">Leadership</span>
            <h2 class="section-title mb-8" style="font-size: 2rem">Department Head</h2>

            <div
                class="mb-16 gap-12 lg:grid-cols-2 grid grid-cols-1 items-center"
                style="background: var(--light); border-radius: 24px; padding: 3rem; border: 1px solid var(--border)"
            >
                <div class="gap-6 flex items-center">
                    <div
                        style="
                            width: 120px;
                            height: 120px;
                            border-radius: 20px;
                            overflow: hidden;
                            flex-shrink: 0;
                            border: 3px solid var(--border);
                        "
                    >
                        <img
                            src="http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/อจแก้ว.jpg"
                            alt="Asst.Prof.Dr.Pikulkaew Tangtisanon"
                            style="width: 100%; height: 100%; object-fit: cover"
                        />
                    </div>
                    <div>
                        <div class="tag mb-2">หัวหน้าภาควิชา · Department Head</div>
                        <h3
                            style="
                                font-family: 'Playfair Display', serif;
                                font-size: 1.5rem;
                                font-weight: 700;
                                color: var(--dark);
                                margin-bottom: 0.25rem;
                            "
                        >
                            Asst.Prof.Dr. Pikulkaew Tangtisanon
                        </h3>
                        <p style="font-size: 0.9rem; color: var(--crimson); font-weight: 500">ผศ.ดร.พิกุลแก้ว ตังติสานนท์</p>
                        <p class="mt-1 text-sm" style="color: var(--muted)">pikulkaew.ta@kmitl.ac.th</p>
                    </div>
                </div>
                <div>
                    <h4 class="mb-2 font-semibold" style="color: var(--dark)">Education</h4>
                    <ul class="mb-4 space-y-1 text-sm" style="color: var(--muted)">
                        <li>วศ.บ. วิศวกรรมสารสนเทศ — KMITL</li>
                        <li>วศ.ม. วิศวกรรมสารสนเทศ — KMITL</li>
                        <li>D.Eng. Science and Technology — Tokai University, Japan</li>
                    </ul>
                    <div class="gap-2 flex flex-wrap">
                        @foreach (['Web Application', 'Mobile Application', 'Information Security'] as $t)
                            <span class="tag" style="font-size: 0.7rem">{{ $t }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FULL FACULTY GRID -->
    <section style="padding: 2rem 0 7rem; background: #fff">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <span class="section-label">Full Faculty</span>
            <h2 class="section-title mb-3" style="font-size: 2rem">คณาจารย์ประจำภาควิชา</h2>
            <div class="accent-line mb-8"></div>

            <div class="gap-6 md:grid-cols-2 lg:grid-cols-4 grid grid-cols-1" id="faculty-grid">
                @foreach ($faculty as $member)
                    <div
                        class="faculty-card faculty-item"
                        data-rank="{{ $member['role'] }}"
                        onclick="openFaculty('{{ Str::slug($member['en']) }}')"
                    >
                        <div class="faculty-avatar">
                            @if ($member['img'])
                                <img
                                    src="{{ $member['img'] }}"
                                    alt="{{ $member['en'] }}"
                                    onerror="
                                        this.style.display = 'none';
                                        this.nextElementSibling.style.display = 'flex';
                                    "
                                />
                                <div class="avatar-placeholder" style="display: none; width: 100%; height: 100%; border-radius: 0">
                                    {{ strtoupper(substr($member['en'], strpos($member['en'], ' ') + 1, 1)) }}
                                </div>
                            @else
                                <div class="avatar-placeholder">
                                    {{ strtoupper(substr($member['en'], strpos($member['en'], ' ') + 1, 1)) }}
                                </div>
                            @endif
                            <div class="faculty-avatar-overlay">
                                <div class="gap-2 flex">
                                    <a href="mailto:{{ $member['email'] }}" class="social-link" title="Email">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                            />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 1.25rem">
                            <span class="role-badge">{{ $member['role'] }}</span>
                            <h3
                                class="mb-1 text-sm leading-tight font-bold"
                                style="color: var(--dark); font-family: 'Playfair Display', serif"
                            >
                                {{ $member['en'] }}
                            </h3>
                            <p class="mb-1 text-xs" style="color: var(--crimson); font-weight: 500">{{ $member['th'] }}</p>
                            <p class="mb-3 text-xs" style="color: var(--muted); font-style: italic">{{ $member['position'] }}</p>
                            <div class="gap-1 flex flex-wrap">
                                @foreach (array_slice($member['research_interests'], 0, 3) as $e)
                                    <span
                                        style="
                                            font-size: 0.62rem;
                                            background: var(--light);
                                            color: var(--muted);
                                            font-weight: 500;
                                            padding: 0.15rem 0.5rem;
                                            border-radius: 4px;
                                        "
                                    >
                                        {{ $e }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="faculty-modal-{{ Str::slug($member['en']) }}" class="faculty-popup">
                        <div class="faculty-popup-card">
                            <button class="popup-close" onclick="closeFaculty('{{ Str::slug($member['en']) }}')">×</button>

                            <div class="popup-header">
                                <div class="faculty-avatar large">
                                    @if ($member['img'])
                                        <img src="{{ $member['img'] }}" alt="{{ $member['en'] }}" />
                                    @else
                                        <div class="avatar-placeholder">
                                            {{ strtoupper(substr($member['en'], strpos($member['en'], ' ') + 1, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <div class="popup-info">
                                    <span class="role-badge">{{ $member['rank_label'] }}</span>

                                    <h2 class="popup-name">
                                        {{ $member['en'] }}
                                    </h2>

                                    <p class="popup-th">{{ $member['th'] }}</p>

                                    <p class="popup-role">{{ $member['role'] }}</p>

                                    <a href="mailto:{{ $member['email'] }}" class="popup-email">
                                        {{ $member['email'] }}
                                    </a>
                                </div>
                            </div>

                            <div class="popup-section">
                                <h4>Research_interests</h4>

                                <div class="gap-2 flex flex-wrap">
                                    @foreach ($member['research_interests'] as $e)
                                        <span class="expertise-tag">{{ $e }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- STAFF -->
    <section style="padding: 4rem 0 6rem; background: var(--light); border-top: 1px solid var(--border)">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <span class="section-label">Department Staff</span>
            <h2 class="section-title mb-8" style="font-size: 2rem">บุคลากรภาควิชา</h2>
            <div class="gap-4 md:grid-cols-2 grid grid-cols-1">
                @foreach ([
                        ['name' => 'Mr. Thanat Jomjaiakchon (นายธนาตย์ จอมใจเอกชน)', 'role' => 'เจ้าหน้าที่วิศวกร'],
                        ['name' => 'Mr. Teerasit Thotong (นายธีรสิทธิ์ โท้ทอง)', 'role' => 'เจ้าหน้าที่วิศวกร']
                    ]
                    as $staff)
                    <div
                        style="
                            background: #fff;
                            border: 1px solid var(--border);
                            border-radius: 12px;
                            padding: 1.25rem 1.5rem;
                            display: flex;
                            align-items: center;
                            gap: 1rem;
                        "
                    >
                        <div
                            style="
                                width: 44px;
                                height: 44px;
                                border-radius: 10px;
                                background: var(--light);
                                border: 1px solid var(--border);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-shrink: 0;
                            "
                        >
                            <svg class="h-5 w-5" style="color: var(--muted)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-semibold" style="color: var(--dark)">{{ $staff['name'] }}</div>
                            <div class="mt-0.5 text-xs" style="color: var(--muted)">{{ $staff['role'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CONTACT CTA -->
    <section style="background: linear-gradient(135deg, var(--crimson), var(--orange)); padding: 4rem 0">
        <div class="max-w-3xl px-4 mx-auto text-center">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 900; color: #fff; margin-bottom: 1rem">
                ติดต่อภาควิชา
            </h2>
            <p style="color: rgba(255, 255, 255, 0.85); margin-bottom: 2rem">ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ อาคาร E-12 ชั้น 11 สจล.</p>
            <div class="gap-4 flex flex-wrap justify-center">
                <a
                    href="mailto:iote@kmitl.ac.th"
                    style="
                        background: #fff;
                        color: var(--crimson);
                        font-weight: 700;
                        padding: 0.75rem 2rem;
                        border-radius: 6px;
                        text-decoration: none;
                    "
                >
                    iote@kmitl.ac.th
                </a>
                <a
                    href="https://www.iote.kmitl.ac.th"
                    target="_blank"
                    style="
                        border: 2px solid rgba(255, 255, 255, 0.7);
                        color: #fff;
                        font-weight: 600;
                        padding: 0.7rem 1.9rem;
                        border-radius: 6px;
                        text-decoration: none;
                    "
                >
                    Visit Official Site
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.filter-btn').forEach((btn) => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.filter-btn').forEach((b) => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.dataset.filter;
                document.querySelectorAll('.faculty-item').forEach((item) => {
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
        function openFaculty(id) {
            document.getElementById('faculty-modal-' + id).style.display = 'flex';
        }

        function closeFaculty(id) {
            document.getElementById('faculty-modal-' + id).style.display = 'none';
        }

        window.addEventListener('click', function (e) {
            document.querySelectorAll('.faculty-popup').forEach((modal) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
@endpush
