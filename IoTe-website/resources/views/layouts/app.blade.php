<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'IoTe KMITL')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap"
            rel="stylesheet"
        />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/main.css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                --crimson: #720a00;
                --orange: #e35205;
                --dark: #1a1a1a;
                --light: #f8f3f0;
                --muted: #6b6360;
                --border: #e2d8d5;
            }
            * {
                font-family: 'DM Sans', sans-serif;
            }
            h1,
            h2,
            h3,
            .display {
                font-family: 'Playfair Display', serif;
            }

            /* Navbar */
            #main-navbar {
                background: rgba(255, 255, 255, 0.96);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid var(--border);
                transition: box-shadow 0.3s;
            }
            #main-navbar.scrolled {
                box-shadow: 0 4px 24px rgba(114, 10, 0, 0.08);
            }
            .nav-link {
                color: var(--dark);
                font-weight: 500;
                font-size: 0.875rem;
                letter-spacing: 0.02em;
                padding: 0.5rem 0.75rem;
                border-radius: 6px;
                transition:
                    color 0.2s,
                    background 0.2s;
                text-decoration: none;
            }
            .nav-link:hover,
            .nav-link.active {
                color: var(--crimson);
                background: rgba(114, 10, 0, 0.06);
            }
            .nav-cta {
                background: var(--crimson);
                color: #fff;
                font-weight: 600;
                font-size: 0.875rem;
                padding: 0.5rem 1.25rem;
                border-radius: 6px;
                transition:
                    background 0.2s,
                    transform 0.15s;
                text-decoration: none;
            }
            .nav-cta:hover {
                background: var(--orange);
                transform: translateY(-1px);
            }

            /* Buttons */
            .btn-primary {
                display: inline-block;
                background: var(--crimson);
                color: #fff;
                font-weight: 600;
                padding: 0.75rem 2rem;
                border-radius: 6px;
                transition:
                    background 0.2s,
                    transform 0.15s;
                text-decoration: none;
            }
            .btn-primary:hover {
                background: #8b0d00;
                transform: translateY(-2px);
            }
            .btn-outline {
                display: inline-block;
                border: 2px solid var(--crimson);
                color: var(--crimson);
                font-weight: 600;
                padding: 0.7rem 1.9rem;
                border-radius: 6px;
                transition: all 0.2s;
                text-decoration: none;
            }
            .btn-outline:hover {
                background: var(--crimson);
                color: #fff;
            }

            /* Section */
            .section-label {
                display: inline-block;
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--orange);
                margin-bottom: 0.75rem;
            }
            .section-title {
                font-family: 'Playfair Display', serif;
                font-size: 2.25rem;
                font-weight: 900;
                color: var(--dark);
                line-height: 1.2;
            }
            @media (min-width: 768px) {
                .section-title {
                    font-size: 2.75rem;
                }
            }

            /* Card */
            .card {
                background: #fff;
                border: 1px solid var(--border);
                border-radius: 12px;
                overflow: hidden;
                transition:
                    box-shadow 0.25s,
                    transform 0.25s;
            }
            .card:hover {
                box-shadow: 0 12px 36px rgba(114, 10, 0, 0.1);
                transform: translateY(-4px);
            }

            /* Tag */
            .tag {
                display: inline-block;
                background: rgba(227, 82, 5, 0.1);
                color: var(--orange);
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                padding: 0.25rem 0.75rem;
                border-radius: 20px;
            }

            /* Divider accent */
            .accent-line {
                width: 56px;
                height: 4px;
                background: linear-gradient(90deg, var(--crimson), var(--orange));
                border-radius: 2px;
                margin-bottom: 1.5rem;
            }
        </style>
        @stack('styles')
    </head>
    <body class="bg-white" style="color: var(--dark)">
        <!-- NAVBAR -->
        <nav id="main-navbar" class="fixed top-0 z-50 w-full">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg" style="background: var(--crimson)">
                            <span class="text-sm font-bold text-white" style="font-family: 'Playfair Display', serif">Io</span>
                        </div>
                        <div>
                            <span
                                class="block text-base leading-none font-bold"
                                style="color: var(--crimson); font-family: 'Playfair Display', serif"
                            >
                                IoTe
                            </span>
                            <span class="text-xs leading-none font-medium" style="color: var(--muted)">KMITL</span>
                        </div>
                    </a>

                    <!-- Desktop Nav -->
                    <div class="hidden sm:flex sm:items-center sm:gap-6">
                        <div class="md:flex md:items-center md:gap-1">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                            <a
                                href="{{ route('laboratories.index') }}"
                                class="nav-link {{ request()->routeIs('laboratories*') ? 'active' : '' }}"
                            >
                                Laboratories
                            </a>
                            <a href="{{ route('admission') }}" class="nav-link {{ request()->routeIs('admission') ? 'active' : '' }}">
                                Admission
                            </a>
                            <a href="{{ route('syllabus') }}" class="nav-link {{ request()->routeIs('syllabus') ? 'active' : '' }}">
                                Syllabus
                            </a>
                            <a href="{{ route('faculty') }}" class="nav-link {{ request()->routeIs('faculty') ? 'active' : '' }}">
                                Faculty
                            </a>

                            <a href="{{ route('contacts') }}" class="nav-link {{ request()->routeIs('contacts') ? 'active' : '' }}">
                                Contact
                            </a>
                        </div>
                        <a href="{{ route('admission') }}" class="nav-cta hidden md:inline-block">Apply Now</a>
                    </div>

                    <!-- Mobile Toggle -->
                    <button id="mobile-menu-btn" class="rounded-lg p-2 md:hidden" style="color: var(--dark)">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden space-y-1 border-t bg-white px-4 py-3 md:hidden" style="border-color: var(--border)">
                <a href="{{ route('home') }}" class="nav-link block w-full">Home</a>
                <a href="{{ route('laboratories.index') }}" class="nav-link block w-full">Laboratories</a>
                <a href="{{ route('admission') }}" class="nav-link block w-full">Admission</a>
                <a href="{{ route('syllabus') }}" class="nav-link block w-full">Syllabus</a>
                <a href="{{ route('faculty') }}" class="nav-link block w-full">Faculty</a>

                <a href="{{ route('contacts') }}" class="nav-link block w-full">Contact</a>

                <a href="{{ route('admission') }}" class="nav-cta mt-2 block text-center">Apply Now</a>
            </div>
        </nav>

        <!-- CONTENT -->
        <main class="pt-16">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer style="background: var(--dark); color: #fff" class="mt-24">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-10 md:grid-cols-4">
                    <div class="md:col-span-2">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg" style="background: var(--crimson)">
                                <span class="font-bold text-white" style="font-family: 'Playfair Display', serif">Io</span>
                            </div>
                            <span class="text-xl font-bold" style="font-family: 'Playfair Display', serif">IoTe KMITL</span>
                        </div>
                        <p class="mb-4 text-sm leading-relaxed" style="color: #a8a0a0; max-width: 320px">
                            Internet of Things Engineering at King Mongkut's Institute of Technology Ladkrabang
                        </p>
                        <div class="flex gap-3">
                            <a
                                href="https://www.facebook.com/IOTE.KMITL"
                                class="flex h-9 w-9 items-center justify-center rounded-lg transition-colors"
                                style="background: rgba(255, 255, 255, 0.08)"
                                onmouseover="this.style.background = 'var(--crimson)'"
                                onmouseout="this.style.background = 'rgba(255,255,255,0.08)'"
                            >
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"
                                    />
                                </svg>
                            </a>
                            <a
                                href="https://www.instagram.com/kmitl.iote.official/"
                                class="flex h-9 w-9 items-center justify-center rounded-lg transition-colors"
                                style="background: rgba(255, 255, 255, 0.08)"
                                onmouseover="this.style.background = 'var(--crimson)'"
                                onmouseout="this.style.background = 'rgba(255,255,255,0.08)'"
                            >
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-4 text-sm font-semibold tracking-wider uppercase" style="color: var(--orange)">Navigation</h4>
                        <ul class="space-y-2 text-sm" style="color: #a8a0a0">
                            <li><a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a></li>
                            <li>
                                <a href="{{ route('laboratories.index') }}" class="transition-colors hover:text-white">Laboratories</a>
                            </li>
                            <li><a href="{{ route('admission') }}" class="transition-colors hover:text-white">Admission</a></li>
                            <li><a href="{{ route('syllabus') }}" class="transition-colors hover:text-white">Syllabus</a></li>
                            <li><a href="{{ route('faculty') }}" class="transition-colors hover:text-white">Faculty</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-4 text-sm font-semibold tracking-wider uppercase" style="color: var(--orange)">Contact</h4>
                        <ul class="space-y-2 text-sm" style="color: #a8a0a0">
                            <li>KMITL, Ladkrabang</li>
                            <li>Bangkok 10520, Thailand</li>
                            <li class="mt-3">
                                <a href="mailto:iote@kmitl.ac.th" class="transition-colors hover:text-white">iote@kmitl.ac.th</a>
                            </li>
                            <li><a href="tel:+6623298000" class="transition-colors hover:text-white">+66 2 329 8000</a></li>
                        </ul>
                    </div>
                </div>
                <div
                    class="mt-12 flex flex-col items-center justify-between gap-4 pt-8 text-sm md:flex-row"
                    style="border-top: 1px solid rgba(255, 255, 255, 0.1); color: #a8a0a0"
                >
                    <p>© {{ date('Y') }} IoTe KMITL. All rights reserved.</p>
                    <p>King Mongkut's Institute of Technology Ladkrabang</p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
        <script>
            // Navbar scroll effect
            window.addEventListener('scroll', () => {
                const nav = document.getElementById('main-navbar');
                nav.classList.toggle('scrolled', window.scrollY > 20);
            });
            // Mobile menu toggle
            document.getElementById('mobile-menu-btn').addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        </script>
        @stack('scripts')
    </body>
</html>
