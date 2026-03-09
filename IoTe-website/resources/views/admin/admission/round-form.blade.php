@extends('layouts.app')
@section('title', isset($round) && $round ? 'Edit Round' : 'Add Round')

@push('styles')
    <style>
        .form-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
        }
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .form-input {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 0.9rem;
            transition: border-color 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--crimson);
            box-shadow: 0 0 0 3px rgba(114, 10, 0, 0.08);
        }
        .form-error {
            color: #dc2626;
            font-size: 0.78rem;
            margin-top: 0.3rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
    </style>
@endpush

@section('content')
    <section style="background: var(--dark); padding: 3.5rem 0 2.5rem; position: relative; overflow: hidden">
        <div
            style="position: absolute; inset: 0; background: radial-gradient(ellipse at 70% 50%, rgba(114, 10, 0, 0.4), transparent 65%)"
        ></div>
        <div class="max-w-3xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <a
                href="{{ route('admin.admission.index') }}"
                style="
                    color: rgba(255, 255, 255, 0.5);
                    font-size: 0.8rem;
                    text-decoration: none;
                    display: inline-block;
                    margin-bottom: 1rem;
                "
            >
                ← กลับ
            </a>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 900; color: #fff">
                {{ isset($round) && $round ? 'แก้ไขรอบการรับสมัคร' : 'เพิ่มรอบการรับสมัคร' }}
            </h1>
        </div>
    </section>

    <section style="padding: 3rem 0; background: var(--light)">
        <div class="max-w-3xl px-4 sm:px-6 lg:px-8 mx-auto">
            <form
                method="POST"
                action="{{ isset($round) && $round ? route('admin.admission.rounds.update', $round) : route('admin.admission.rounds.store') }}"
            >
                @csrf
                @if (isset($round) && $round)
                    @method('PUT')
                @endif

                <div class="form-card">
                    <div class="md:grid-cols-2 gap-4 grid grid-cols-1">
                        <div class="form-group">
                            <label class="form-label">รอบที่ (Round Number) *</label>
                            <input
                                type="number"
                                name="round_number"
                                class="form-input"
                                min="1"
                                value="{{ old('round_number', $round?->round_number) }}"
                                required
                            />
                            @error('round_number')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">ชื่อรอบ (EN) *</label>
                            <input
                                type="text"
                                name="round_name"
                                class="form-input"
                                value="{{ old('round_name', $round?->round_name) }}"
                                placeholder="PORTFOLIO"
                                required
                            />
                            @error('round_name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">ชื่อรอบ (TH) *</label>
                            <input
                                type="text"
                                name="round_name_th"
                                class="form-input"
                                value="{{ old('round_name_th', $round?->round_name_th) }}"
                                placeholder="รับด้วย Portfolio"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label class="form-label">จำนวนที่นั่งรวม *</label>
                            <input
                                type="number"
                                name="total_seats"
                                class="form-input"
                                min="0"
                                value="{{ old('total_seats', $round?->total_seats) }}"
                                required
                            />
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label">คำอธิบาย (Description)</label>
                            <textarea name="description" class="form-input" rows="3">
{{ old('description', $round?->description) }}</textarea
                            >
                        </div>
                        <div class="form-group">
                            <label class="form-label">ลำดับการแสดง</label>
                            <input
                                type="number"
                                name="sort_order"
                                class="form-input"
                                value="{{ old('sort_order', $round?->sort_order ?? 0) }}"
                            />
                        </div>
                    </div>
                    <div class="gap-4 mt-4 flex">
                        <button type="submit" class="btn-primary">💾 บันทึก</button>
                        <a href="{{ route('admin.admission.index') }}" class="btn-outline">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
