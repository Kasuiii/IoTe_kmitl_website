@extends('layouts.app')
@section('title', $project ? 'Edit Project' : 'Add Project')

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
            <div
                style="
                    color: rgba(255, 163, 107, 0.9);
                    font-size: 0.8rem;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.1em;
                    margin-bottom: 0.4rem;
                "
            >
                รอบที่ {{ $round->round_number }} — {{ $round->round_name }}
            </div>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 900; color: #fff">
                {{ $project ? 'แก้ไขโครงการ' : 'เพิ่มโครงการรับสมัคร' }}
            </h1>
        </div>
    </section>

    <section style="padding: 3rem 0; background: var(--light)">
        <div class="max-w-3xl px-4 sm:px-6 lg:px-8 mx-auto">
            <form
                method="POST"
                action="{{ $project ? route('admin.admission.projects.update', $project) : route('admin.admission.projects.store', $round) }}"
            >
                @csrf
                @if ($project)
                    @method('PUT')
                @endif

                <div class="form-card">
                    <div class="md:grid-cols-2 gap-4 grid grid-cols-1">
                        <div class="form-group md:col-span-2">
                            <label class="form-label">ชื่อโครงการ (EN) *</label>
                            <input
                                type="text"
                                name="project_name"
                                class="form-input"
                                value="{{ old('project_name', $project?->project_name) }}"
                                placeholder="Young Engineering Talent"
                                required
                            />
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label">ชื่อโครงการ (TH) *</label>
                            <input
                                type="text"
                                name="project_name_th"
                                class="form-input"
                                value="{{ old('project_name_th', $project?->project_name_th) }}"
                                placeholder="โครงการรับนักเรียนที่มีความสามารถพิเศษ"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label class="form-label">จำนวนที่นั่ง *</label>
                            <input
                                type="number"
                                name="seats"
                                class="form-input"
                                min="0"
                                value="{{ old('seats', $project?->seats) }}"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label class="form-label">GPAX ขั้นต่ำ</label>
                            <input
                                type="text"
                                name="gpax_min"
                                class="form-input"
                                value="{{ old('gpax_min', $project?->gpax_min) }}"
                                placeholder="2.50"
                            />
                        </div>
                        <div class="form-group md:col-span-2">
                            {{-- Each line = one requirement bullet --}}
                            <label class="form-label">คุณสมบัติ (1 บรรทัด = 1 ข้อ)</label>
                            <textarea
                                name="requirements"
                                class="form-input"
                                rows="5"
                                placeholder="ผ่านการทดสอบ สสวท.&#10;มีผลงานด้านโอลิมปิกวิชาการ&#10;GPA 3.00 ขึ้นไป"
                            >
{{ old('requirements', $project?->requirements) }}</textarea
                            >
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label">เกณฑ์การคัดเลือก / Score Criteria</label>
                            <textarea
                                name="score_criteria"
                                class="form-input"
                                rows="3"
                                placeholder="TGAT 20% + TPAT3 25% + A-Level Math 25% + A-Level Physics 30%"
                            >
{{ old('score_criteria', $project?->score_criteria) }}</textarea
                            >
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label">หมายเหตุ / Notes</label>
                            <textarea name="notes" class="form-input" rows="2">{{ old('notes', $project?->notes) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">ลำดับการแสดง</label>
                            <input
                                type="number"
                                name="sort_order"
                                class="form-input"
                                value="{{ old('sort_order', $project?->sort_order ?? 0) }}"
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
