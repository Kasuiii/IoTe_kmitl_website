@extends('layouts.app')
@section('title', 'Equipment Reservation')

@section('content')
    <section class="contact-hero">
        <div class="max-w-7xl px-4 mx-auto">
            <h1 style="color: rgb(255, 0, 0); font-size: 3rem; font-weight: 800">Equipment Reservation</h1>

            <p style="color: rgba(132, 131, 131, 0.8)">Reserve laboratory equipment for courses and research.</p>
        </div>
    </section>

    <section style="padding: 5rem 0; background: var(--light)">
        <div class="max-w-7xl px-4 mx-auto">
            @foreach ($byCategory as $category => $items)
                <h2 class="section-title mb-6">{{ $category }}</h2>

                <div class="md:grid-cols-3 gap-6 grid">
                    @foreach ($items as $item)
                        <div class="info-card">
                            @if ($item->image_url)
                                <img src="{{ $item->image_url }}" style="width: 100%; height: 180px; object-fit: cover" />
                            @endif

                            <div class="p-6">
                                <h3 style="font-weight: 700; font-size: 1.1rem">
                                    {{ $item->name }}
                                </h3>

                                <p class="text-sm mt-2">Available: {{ $item->real_available }}</p>

                                <a
                                    href="{{ route('reservations.create', $item) }}"
                                    class="mt-4 px-4 py-2 rounded inline-block"
                                    style="background: var(--crimson); color: white"
                                >
                                    Reserve
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
@endsection
