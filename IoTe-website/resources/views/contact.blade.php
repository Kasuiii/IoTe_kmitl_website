@extends('layouts.app')
@section('title', 'Contact Us — IoTe KMITL')

@push('styles')
    <style>
        /* HERO */
        .contact-hero {
            background: var(--dark);
            padding: 7rem 0 5rem;
            position: relative;
            overflow: hidden;
        }
        .contact-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 75% 50%, rgba(114, 10, 0, 0.45), transparent 65%);
        }

        /* INFO CARD */
        .info-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            transition:
                box-shadow 0.3s,
                transform 0.3s;
        }
        .info-card:hover {
            box-shadow: 0 20px 56px rgba(114, 10, 0, 0.1);
            transform: translateY(-4px);
        }
        .info-card-header {
            padding: 2.5rem 2.5rem 2rem;
            background: linear-gradient(135deg, var(--crimson), var(--orange));
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .info-card-header::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -80px;
            right: -60px;
        }
        .info-card-body {
            padding: 2.5rem;
        }

        /* CONTACT ROW */
        .contact-row {
            display: flex;
            gap: 1.25rem;
            align-items: flex-start;
            padding: 1.25rem 0;
            border-bottom: 1px solid var(--border);
        }
        .contact-row:last-child {
            border-bottom: none;
        }
        .contact-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(114, 10, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--crimson);
        }

        /* MAP EMBED */
        .map-wrapper {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 8px 32px rgba(114, 10, 0, 0.08);
            background: var(--light);
        }
        .map-wrapper img {
            width: 100%;
            display: block;
            transition: transform 0.5s;
        }
        .map-wrapper:hover img {
            transform: scale(1.02);
        }

        /* DIVIDER NUMBER */
        .dept-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--crimson), var(--orange));
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        /* SOCIAL LINK */
        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s;
        }
        .social-link:hover {
            background: var(--crimson);
            color: #fff;
            border-color: var(--crimson);
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="contact-hero">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <span class="section-label" style="color: rgba(255, 163, 107, 0.9)">Get in Touch</span>
            <h1
                style="
                    font-family: 'Playfair Display', serif;
                    font-size: clamp(2.5rem, 5vw, 4rem);
                    font-weight: 900;
                    color: #fff;
                    line-height: 1.1;
                    max-width: 680px;
                    margin-bottom: 1.25rem;
                "
            >
                Contact
                <br />
                <em style="color: #ffaa77">IoTe KMITL</em>
            </h1>
            <p style="color: rgba(255, 255, 255, 0.72); font-size: 1.125rem; line-height: 1.8; max-width: 520px; margin-bottom: 2.5rem">
                ติดต่อภาควิชาวิศวกรรมไอโอทีและสารสนเทศ หรือหลักสูตรฟิสิกส์อุตสาหกรรม คณะวิทยาศาสตร์ สจล.
            </p>
            <div class="gap-3 flex flex-wrap">
                <a
                    href="mailto:iote@kmitl.ac.th"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                        background: var(--crimson);
                        color: #fff;
                        padding: 0.7rem 1.5rem;
                        border-radius: 8px;
                        font-size: 0.9rem;
                        font-weight: 600;
                        text-decoration: none;
                    "
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>
                    iote@kmitl.ac.th
                </a>
                <a
                    href="https://maps.app.goo.gl/Gpw3btgpKYPCcWWz8"
                    target="_blank"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                        background: rgba(255, 255, 255, 0.1);
                        border: 1px solid rgba(255, 255, 255, 0.25);
                        color: #fff;
                        padding: 0.7rem 1.5rem;
                        border-radius: 8px;
                        font-size: 0.9rem;
                        font-weight: 600;
                        text-decoration: none;
                    "
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Get Directions ↗
                </a>
            </div>
        </div>
    </section>

    <!-- QUICK CONTACT BAR -->
    <section style="background: var(--crimson); padding: 1.5rem 0">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="gap-8 flex flex-wrap items-center justify-between">
                @foreach ([
                        ['📍', 'Location', 'E-12 Building, KMITL Ladkrabang'],
                        ['📧', 'Email', 'iote@kmitl.ac.th'],
                        ['📞', 'Phone', '02-329-8000 ext.5129'],
                        ['🕐', 'Office Hours', 'Mon – Fri, 8:30 – 16:30']
                    ]
                    as [$icon, $label, $val])
                    <div class="gap-3 flex items-center" style="color: #fff">
                        <span style="font-size: 1.25rem">{{ $icon }}</span>
                        <div>
                            <div style="font-size: 0.7rem; opacity: 0.7; letter-spacing: 0.1em; text-transform: uppercase">
                                {{ $label }}
                            </div>
                            <div style="font-size: 0.9rem; font-weight: 600">{{ $val }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- MAIN CONTACT CARDS -->
    <section style="padding: 6rem 0; background: var(--light)">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="mb-14 text-center">
                <span class="section-label">ติดต่อหน่วยงาน</span>
                <h2 class="section-title">Department Contacts</h2>
                <div class="accent-line mt-4 mx-auto"></div>
            </div>

            @php
                $contacts = [
                    [
                        'number' => '01',
                        'label' => 'Engineering Faculty · คณะวิศวกรรมศาสตร์',
                        'title' => 'ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ',
                        'subtitle' => 'Department of IoT and Information Engineering',
                        'color' => 'linear-gradient(135deg, var(--crimson), var(--orange))',
                        'map' => 'https://old-engineer.kmitl.ac.th/wp-content/uploads/2020/06/4-11.jpg',
                        'maplink' => 'https://kmitl-map.vercel.app/',
                        'mapgoogle' => 'https://www.google.com/maps/search/13.727629,+100.772419',
                        'email' => ['iote@kmitl.ac.th', 'pikulkaew.ta@kmitl.ac.th'],
                        'phone' => ['02-329-8000 ext.5129', '02-329-8301 ext.235'],
                        'location' => ['ชั้น 12 อาคารเรียนรวม 12 ชั้น (E-12)', 'คณะวิศวกรรมศาสตร์ สจล.', 'เลขที่ 1 ซอยฉลองกรุง 1 แขวงลาดกระบัง', 'กรุงเทพมหานคร 10520'],
                        'website' => 'https://www.iote.kmitl.ac.th/',
                        'tags' => ['IoT Engineering', 'B.Eng Programme', 'Dual Degree'],
                    ],
                    [
                        'number' => '02',
                        'label' => 'Science Faculty · คณะวิทยาศาสตร์',
                        'title' => 'ภาควิชาฟิสิกส์อุตสาหกรรม',
                        'subtitle' => 'Department of Industrial Physics',
                        'color' => 'linear-gradient(135deg, #1a1a2e, #720a00)',
                        'map' => 'https://old-engineer.kmitl.ac.th/wp-content/uploads/2020/06/2-11.jpg',
                        'maplink' => 'https://www.iote.kmitl.ac.th/dual-degree-b-eng-iot-system-and-information-b-sc-industrial-physics/',
                        'mapgoogle' => 'https://www.google.com/maps/place/Applied+Physics+KMITL/',
                        'email' => ['science@kmitl.ac.th'],
                        'phone' => ['02-329-8000 ext.6214'],
                        'location' => ['ตึกจุฬาภรณ์วลัยลักษณ์ 1 ชั้น 3', 'คณะวิทยาศาสตร์ สจล.', 'เลขที่ 1 ซอยฉลองกรุง 1 แขวงลาดกระบัง', 'กรุงเทพมหานคร 10520'],
                        'website' => 'https://www.iote.kmitl.ac.th/dual-degree-b-eng-iot-system-and-information-b-sc-industrial-physics/',
                        'tags' => ['Industrial Physics', 'B.Sc Programme', 'Dual Degree PhysIoT'],
                    ],
                ];
            @endphp

            <div class="space-y-16">
                @foreach ($contacts as $i => $contact)
                    <div class="lg:grid-cols-2 gap-10 {{ $i % 2 == 1 ? '' : '' }} grid grid-cols-1 items-start">
                        <!-- Info Card -->
                        <div class="info-card">
                            <div class="info-card-header" style="background: {{ $contact['color'] }}">
                                <div class="gap-3 mb-4 flex items-center">
                                    <span class="dept-number" style="background: #fff; color: var(--crimson)">
                                        {{ $contact['number'] }}
                                    </span>
                                    <span style="font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase; opacity: 0.8">
                                        {{ $contact['label'] }}
                                    </span>
                                </div>
                                <h3
                                    style="
                                        font-family: 'Playfair Display', serif;
                                        font-size: 1.5rem;
                                        font-weight: 900;
                                        line-height: 1.2;
                                        margin-bottom: 0.5rem;
                                    "
                                >
                                    {{ $contact['title'] }}
                                </h3>
                                <p style="font-size: 0.9rem; opacity: 0.85; margin-bottom: 1.25rem">{{ $contact['subtitle'] }}</p>
                                <div class="gap-2 flex flex-wrap">
                                    @foreach ($contact['tags'] as $tag)
                                        <span
                                            style="
                                                background: rgba(255, 255, 255, 0.15);
                                                color: #fff;
                                                font-size: 0.7rem;
                                                font-weight: 600;
                                                letter-spacing: 0.06em;
                                                text-transform: uppercase;
                                                padding: 0.25rem 0.75rem;
                                                border-radius: 20px;
                                            "
                                        >
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="info-card-body">
                                <!-- Email -->
                                <div class="contact-row">
                                    <div class="contact-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold tracking-wider mb-1 uppercase" style="color: var(--orange)">
                                            Email
                                        </div>
                                        @foreach ($contact['email'] as $mail)
                                            <a
                                                href="mailto:{{ $mail }}"
                                                class="text-sm font-medium block transition-colors"
                                                style="color: var(--dark)"
                                                onmouseover="this.style.color = 'var(--crimson)'"
                                                onmouseout="this.style.color = 'var(--dark)'"
                                            >
                                                {{ $mail }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="contact-row">
                                    <div class="contact-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold tracking-wider mb-1 uppercase" style="color: var(--orange)">
                                            Phone
                                        </div>
                                        @foreach ($contact['phone'] as $phone)
                                            <a
                                                href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}"
                                                class="text-sm font-medium block"
                                                style="color: var(--dark)"
                                            >
                                                {{ $phone }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="contact-row">
                                    <div class="contact-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold tracking-wider mb-1 uppercase" style="color: var(--orange)">
                                            Location
                                        </div>
                                        @foreach ($contact['location'] as $line)
                                            <div class="text-sm" style="color: var(--dark); line-height: 1.8">{{ $line }}</div>
                                        @endforeach

                                        <a
                                            href="{{ $contact['mapgoogle'] }}"
                                            target="_blank"
                                            class="gap-1 mt-2 text-sm font-semibold inline-flex items-center transition-colors"
                                            style="color: var(--crimson)"
                                            onmouseover="this.style.color = 'var(--orange)'"
                                            onmouseout="this.style.color = 'var(--crimson)'"
                                        >
                                            Get Directions
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                                />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <!-- Website -->
                                <div class="pt-5">
                                    <a href="{{ $contact['website'] }}" target="_blank" class="social-link">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"
                                            />
                                        </svg>
                                        Visit Official Website
                                    </a>
                                    <a href="{{ $contact['maplink'] }}" target="_blank" class="social-link ml-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"
                                            />
                                        </svg>
                                        View Campus Map
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Map Image -->
                        <div class="{{ $i % 2 == 1 ? 'lg:order-first' : '' }}">
                            <div class="map-wrapper mb-5">
                                <a href="{{ $contact['mapgoogle'] }}" target="_blank">
                                    <img
                                        src="{{ $contact['map'] }}"
                                        alt="Campus Map — {{ $contact['title'] }}"
                                        loading="lazy"
                                        onerror="
                                            this.parentElement.parentElement.style.background = '#e2d8d5';
                                            this.style.display = 'none';
                                        "
                                    />
                                </a>
                            </div>
                            <!-- Direction CTA -->
                            <a
                                href="{{ $contact['mapgoogle'] }}"
                                target="_blank"
                                class="p-5 rounded-2xl flex items-center justify-between transition-all"
                                style="background: #fff; border: 1px solid var(--border); text-decoration: none"
                                onmouseover="
                                    this.style.borderColor = 'var(--crimson)';
                                    this.style.boxShadow = '0 8px 24px rgba(114,10,0,0.1)';
                                "
                                onmouseout="
                                    this.style.borderColor = 'var(--border)';
                                    this.style.boxShadow = 'none';
                                "
                            >
                                <div class="gap-4 flex items-center">
                                    <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: var(--crimson)">
                                        <svg
                                            class="w-5 h-5 text-white"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            style="color: #fff"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm" style="color: var(--dark)">Open in Google Maps</div>
                                        <div class="text-xs" style="color: var(--muted)">KMITL Ladkrabang, Bangkok</div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--crimson)">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    @if (! $loop->last)
                        <div class="gap-4 flex items-center">
                            <div class="h-px flex-1" style="background: var(--border)"></div>
                            <span class="text-xs font-semibold tracking-widest uppercase" style="color: var(--muted)">Also at KMITL</span>
                            <div class="h-px flex-1" style="background: var(--border)"></div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- SOCIAL / LINKS -->
    <section style="padding: 5rem 0; background: #fff">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="mb-12 text-center">
                <span class="section-label">Follow Us</span>
                <h2 class="section-title">Stay Connected</h2>
                <div class="accent-line mt-4 mx-auto"></div>
            </div>
            <div class="md:grid-cols-3 gap-6 max-w-3xl mx-auto grid grid-cols-1">
                @foreach ([
                        [
                            'https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg',
                            'Official instagram',
                            'Instagram @kmitl.iote.official',
                            'https://www.instagram.com/kmitl.iote.official/',
                            'Visit for latest news, faculty, and academic updates.'
                        ],
                        [
                            'https://www.svgrepo.com/show/452196/facebook-1.svg',
                            'Facebook Page',
                            'IoTe KMITL',
                            'https://www.facebook.com/IOTE.KMITL',
                            'Follow us for events, activities, and student highlights.'
                        ],
                        [
                            'https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/KMITL_Sublogo.svg/960px-KMITL_Sublogo.svg.png',
                            'Admission Portal',
                            'admission.reg.kmitl.ac.th',
                            'http://admission.reg.kmitl.ac.th/',
                            'Apply for the 2569 intake — Portfolio, Quota, Admission.'
                        ]
                    ]
                    as [$icon, $label, $handle, $url, $desc])
                    <a
                        href="{{ $url }}"
                        target="_blank"
                        class="group p-6 rounded-2xl transition-all"
                        style="border: 1px solid var(--border); background: #fff; text-decoration: none; display: block"
                        onmouseover="
                            this.style.boxShadow = '0 12px 36px rgba(114,10,0,0.1)';
                            this.style.borderColor = 'var(--crimson)';
                            this.style.transform = 'translateY(-4px)';
                        "
                        onmouseout="
                            this.style.boxShadow = 'none';
                            this.style.borderColor = 'var(--border)';
                            this.style.transform = 'translateY(0)';
                        "
                    >
                        <div class="text-3xl mb-3"><img src="{{ $icon }}" alt="{{ $label }}" class="h-8 w-8 object-contain" /></div>
                        <div class="text-xs font-semibold tracking-wider mb-1 uppercase" style="color: var(--orange)">{{ $label }}</div>
                        <div class="font-bold text-base mb-2" style="color: var(--dark); font-family: 'Playfair Display', serif">
                            {{ $handle }}
                        </div>
                        <p class="text-xs leading-relaxed" style="color: var(--muted)">{{ $desc }}</p>
                        <div class="mt-4 text-xs font-semibold gap-1 flex items-center" style="color: var(--crimson)">
                            Open Link
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section
        style="background: linear-gradient(135deg, var(--crimson), var(--orange)); padding: 4.5rem 0; position: relative; overflow: hidden"
    >
        <div
            style="
                position: absolute;
                inset: 0;
                background: url('http://www.iote.kmitl.ac.th/wp-content/uploads/2024/01/6.jpg') center/cover;
                opacity: 0.07;
            "
        ></div>
        <div class="max-w-4xl px-4 mx-auto text-center" style="position: relative; z-index: 1">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2.25rem; font-weight: 900; color: #fff; margin-bottom: 1rem">
                มีคำถามเกี่ยวกับการรับสมัคร?
            </h2>
            <p style="color: rgba(255, 255, 255, 0.85); font-size: 1rem; max-width: 520px; margin: 0 auto 2.5rem">
                ดูรายละเอียดการรับสมัครนักศึกษาประจำปี 2569 หรือติดต่อเราโดยตรงที่ iote@kmitl.ac.th
            </p>
            <div class="gap-4 flex flex-wrap justify-center">
                <a
                    href="{{ route('admission.index') }}"
                    style="
                        background: #fff;
                        color: var(--crimson);
                        font-weight: 700;
                        padding: 0.85rem 2.25rem;
                        border-radius: 6px;
                        text-decoration: none;
                        font-size: 1rem;
                        transition: all 0.2s;
                    "
                    onmouseover="this.style.transform = 'translateY(-2px)'"
                    onmouseout="this.style.transform = 'none'"
                >
                    ดูข้อมูลการรับสมัคร
                </a>
                <a
                    href="mailto:iote@kmitl.ac.th"
                    style="
                        border: 2px solid rgba(255, 255, 255, 0.7);
                        color: #fff;
                        font-weight: 600;
                        padding: 0.8rem 2rem;
                        border-radius: 6px;
                        text-decoration: none;
                        font-size: 1rem;
                        transition: all 0.2s;
                    "
                    onmouseover="this.style.background = 'rgba(255,255,255,0.15)'"
                    onmouseout="this.style.background = 'transparent'"
                >
                    Email Us
                </a>
            </div>
        </div>
    </section>
@endsection
