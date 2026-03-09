@extends('layouts.app')

@section('title', 'Reserve Equipment')

@section('content')
    <section class="contact-hero">
        <div class="max-w-5xl px-4 mx-auto">
            <h1 style="color: white; font-size: 2.5rem; font-weight: 800">Reserve {{ $item->name }}</h1>
        </div>
    </section>

    <section style="padding: 5rem 0; background: var(--light)">
        <div class="max-w-xl bg-white p-8 rounded-2xl shadow mx-auto">
            <form method="POST" action="{{ route('reservations.store', $item) }}">
                @csrf

                <label>Quantity</label>

                <input
                    type="number"
                    name="quantity_requested"
                    min="1"
                    max="{{ $availableQty }}"
                    value="1"
                    class="rounded p-2 mb-4 w-full border"
                />

                <label>Borrow Date</label>

                <input type="date" name="borrow_date" class="rounded p-2 mb-4 w-full border" />

                <label>Return Date</label>

                <input type="date" name="return_date" class="rounded p-2 mb-4 w-full border" />

                <label>Purpose</label>

                <textarea name="purpose" class="rounded p-2 mb-4 w-full border"></textarea>

                <button class="px-6 py-2 rounded" style="background: var(--crimson); color: white">Submit Reservation</button>
            </form>
        </div>
    </section>
@endsection
