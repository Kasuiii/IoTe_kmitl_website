@extends('layouts.app')
@section('title', $member ? 'Edit Faculty' : 'Add Faculty')

@push('styles')
    <style>
        .form-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
        }
        .form-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 900;
            color: var(--dark);
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--border);
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.4rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
        .form-input {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 0.9rem;
            color: var(--dark);
            transition:
                border-color 0.2s,
                box-shadow 0.2s;
            background: #fff;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--crimson);
            box-shadow: 0 0 0 3px rgba(114, 10, 0, 0.08);
        }
        .form-input.error {
            border-color: #dc2626;
        }
        .form-error {
            color: #dc2626;
            font-size: 0.78rem;
            margin-top: 0.3rem;
        }
        .photo-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--border);
            display: block;
            margin-bottom: 0.75rem;
        }

        /* Education rows */
        .education-block {
            background: #f9fafb;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem;
            position: relative;
        }
        .education-block .edu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.6rem;
        }
        .education-block .edu-grid input {
            padding: 0.55rem 0.8rem;
            border: 1.5px solid var(--border);
            border-radius: 7px;
            font-size: 0.85rem;
            width: 100%;
            background: #fff;
            outline: none;
        }
        .education-block .edu-grid input:focus {
            border-color: var(--crimson);
            box-shadow: 0 0 0 3px rgba(114, 10, 0, 0.08);
        }
        .education-block .edu-grid .full-width {
            grid-column: 1 / -1;
        }
        .btn-remove-edu {
            position: absolute;
            top: 0.6rem;
            right: 0.75rem;
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            border: none;
            border-radius: 6px;
            padding: 0.25rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-remove-edu:hover {
            background: #dc2626;
            color: #fff;
        }
        .btn-add-edu {
            background: rgba(114, 10, 0, 0.08);
            color: var(--crimson);
            border: 1.5px dashed var(--crimson);
            border-radius: 9px;
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 0.5rem;
            transition: all 0.15s;
        }
        .btn-add-edu:hover {
            background: var(--crimson);
            color: #fff;
        }
    </style>
@endpush

@section('content')
    {{-- Hero --}}
    <section style="background: var(--dark); padding: 3.5rem 0 2.5rem; position: relative; overflow: hidden">
        <div
            style="position: absolute; inset: 0; background: radial-gradient(ellipse at 70% 50%, rgba(114, 10, 0, 0.4), transparent 65%)"
        ></div>
        <div class="max-w-5xl px-4 sm:px-6 lg:px-8 mx-auto" style="position: relative; z-index: 1">
            <a
                href="{{ route('admin.faculty.index') }}"
                style="
                    color: rgba(255, 255, 255, 0.5);
                    font-size: 0.8rem;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.4rem;
                    margin-bottom: 1rem;
                "
            >
                ← กลับรายการอาจารย์
            </a>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 900; color: #fff">
                {{ $member ? 'แก้ไขข้อมูลอาจารย์' : 'เพิ่มอาจารย์ใหม่' }}
            </h1>
        </div>
    </section>

    {{-- Form --}}
    <section style="padding: 3rem 0; background: var(--light)">
        <div class="max-w-5xl px-4 sm:px-6 lg:px-8 mx-auto">
            <form
                method="POST"
                action="{{ $member ? route('admin.faculty.update', $member->id) : route('admin.faculty.store') }}"
                enctype="multipart/form-data"
            >
                @csrf
                @if ($member)
                    @method('PUT')
                @endif

                {{-- SECTION 1: Basic Info --}}
                <div class="form-card">
                    <div class="form-section-title">👤 ข้อมูลพื้นฐาน</div>
                    <div class="md:grid-cols-3 gap-4 grid grid-cols-1">
                        <div class="form-group">
                            <label class="form-label">คำนำหน้า (Prefix) *</label>
                            <select name="prefix" class="form-input">
                                @foreach ([
                                        'ศ.' => 'ศาสตราจารย์ (Professor)',
                                        'รศ.' => 'รองศาสตราจารย์ (Assoc.)',
                                        'ผศ.' => 'ผู้ช่วยศาสตราจารย์ (Asst.)',
                                        'ดร.' => 'อาจารย์ (Lecturer)'
                                    ]
                                    as $val => $label)
                                    <option value="{{ $val }}" {{ old('prefix', $member?->prefix) === $val ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            {{--
                                <input
                                type="text"
                                name="prefix"
                                class="form-input @error('prefix') error @enderror"
                                value="{{ old('prefix', $member?->prefix) }}"
                                placeholder="ผศ.ดร. / รศ.ดร."
                                required
                                />
                            --}}
                            @error('prefix')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group md:col-span-2">
                            <label class="form-label">ชื่อภาษาไทย *</label>
                            <input
                                type="text"
                                name="name_th"
                                class="form-input @error('name_th') error @enderror"
                                value="{{ old('name_th', $member?->name_th) }}"
                                required
                            />
                            @error('name_th')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group md:col-span-2">
                            <label class="form-label">ชื่อภาษาอังกฤษ *</label>
                            <input
                                type="text"
                                name="name_en"
                                class="form-input @error('name_en') error @enderror"
                                value="{{ old('name_en', $member?->name_en) }}"
                                required
                            />
                            @error('name_en')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{--
                            <div class="form-group">
                            <label class="form-label">Role *</label>
                            <input
                            type="text"
                            name="position"
                            class="form-input @error('position') error @enderror"
                            value="{{ old('position', $member?->position) }}"
                            placeholder="ผศ.ดร. / รศ.ดร."
                            required
                            />
                            @error('position')
                            <p class="form-error">{{ $message }}</p>
                            @enderror
                            </div>
                        --}}

                        <div class="form-group">
                            <label class="form-label">ตำแหน่งพิเศษ (Role)</label>
                            <input
                                type="text"
                                name="role"
                                class="form-input"
                                value="{{ old('role', $member?->role) }}"
                                placeholder="หัวหน้าภาควิชา / รองหัวหน้า"
                            />
                        </div>

                        <div class="form-group">
                            <label class="form-label">ลำดับการแสดง (Sort Order)</label>
                            <input
                                type="number"
                                name="sort_order"
                                class="form-input"
                                value="{{ old('sort_order', $member?->sort_order ?? 0) }}"
                            />
                            <p style="font-size: 0.73rem; color: var(--muted); margin-top: 0.3rem">เลขน้อย = แสดงก่อน (0 = ค่าเริ่มต้น)</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label gap-2 flex items-center">
                                <input
                                    type="checkbox"
                                    name="is_staff"
                                    value="1"
                                    class="rounded"
                                    {{ old('is_staff', $member?->is_staff) ? 'checked' : '' }}
                                />
                                เจ้าหน้าที่สายสนับสนุน (ไม่ใช่อาจารย์)
                            </label>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: Contact --}}
                <div class="form-card">
                    <div class="form-section-title">📬 ข้อมูลติดต่อ</div>
                    <div class="md:grid-cols-2 gap-4 grid grid-cols-1">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-input @error('email') error @enderror"
                                value="{{ old('email', $member?->email) }}"
                                placeholder="firstname.la@kmitl.ac.th"
                            />
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">โทรศัพท์ (Phone)</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-input"
                                value="{{ old('phone', $member?->phone) }}"
                                placeholder="02-329-8000 ext. 5XXX"
                            />
                        </div>

                        <div class="form-group md:col-span-2">
                            <label class="form-label">ห้องทำงาน / ที่ตั้ง</label>
                            <input
                                type="text"
                                name="office_location"
                                class="form-input"
                                value="{{ old('office_location', $member?->office_location) }}"
                                placeholder="ชั้น 12 อาคาร E-12"
                            />
                        </div>
                    </div>
                </div>

                {{-- ── SECTION 3: Education ── --}}
                <div class="form-card">
                    <div class="form-section-title">🎓 ประวัติการศึกษา</div>

                    <div id="educations-container" class="gap-3 flex flex-col">
                        @php
                            $educations = old('educations', $member ? $member->educations->toArray() : []);
                        @endphp

                        @foreach ($educations as $index => $edu)
                            <div class="education-block">
                                <button type="button" class="btn-remove-edu" onclick="removeEducation(this)">✕ ลบ</button>
                                <div class="edu-grid">
                                    <input
                                        type="text"
                                        name="educations[{{ $index }}][degree]"
                                        placeholder="Degree (e.g. Ph.D., M.Sc., B.Eng.)"
                                        value="{{ $edu['degree'] ?? '' }}"
                                        class="full-width"
                                    />
                                    <input
                                        type="text"
                                        name="educations[{{ $index }}][field]"
                                        placeholder="Field of Study (e.g. Computer Engineering)"
                                        value="{{ $edu['field'] ?? '' }}"
                                        class="full-width"
                                    />
                                    <input
                                        type="text"
                                        name="educations[{{ $index }}][university]"
                                        placeholder="University"
                                        value="{{ $edu['university'] ?? '' }}"
                                    />
                                    <input
                                        type="text"
                                        name="educations[{{ $index }}][country]"
                                        placeholder="Country"
                                        value="{{ $edu['country'] ?? '' }}"
                                    />
                                    <input
                                        type="text"
                                        name="educations[{{ $index }}][year]"
                                        placeholder="Year (e.g. 2015)"
                                        value="{{ $edu['year'] ?? '' }}"
                                    />
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn-add-edu" onclick="addEducation()">+ เพิ่มประวัติการศึกษา</button>
                </div>

                {{-- SECTION 4: Research --}}
                <div class="form-card">
                    <div class="form-section-title">🔬 งานวิจัยและความเชี่ยวชาญ</div>

                    <div class="form-group">
                        <label class="form-label">Research Interests (คั่นด้วยเครื่องหมาย ,)</label>
                        <input
                            type="text"
                            name="research_interests"
                            class="form-input"
                            value="{{ old('research_interests', $member?->research_interests) }}"
                            placeholder="IoT Security, Machine Learning, Embedded Systems"
                        />
                        <p style="font-size: 0.73rem; color: var(--muted); margin-top: 0.3rem">
                            ตัวอย่าง: IoT Security, Edge AI — จะแสดงเป็น tag บนหน้าเว็บ
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Study Paths / สายการเรียนรู้ที่แนะนำ</label>
                        <textarea name="study_paths" class="form-input" rows="3" placeholder="แนะนำสำหรับสาย Embedded / แนะนำสำหรับสาย AI">
{{ old('study_paths', $member?->study_paths) }}</textarea
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">ประวัติย่อ (Bio)</label>
                        <textarea
                            name="bio"
                            class="form-input"
                            rows="4"
                            placeholder="ประวัติการศึกษา ความเชี่ยวชาญ ผลงานที่น่าภาคภูมิใจ..."
                        >
{{ old('bio', $member?->bio) }}</textarea
                        >
                    </div>
                </div>

                {{-- SECTION 5: Photo --}}
                <div class="form-card">
                    <div class="form-section-title">📷 รูปโปรไฟล์</div>

                    @if ($member?->photo_url)
                        <p style="font-size: 0.8rem; color: var(--muted); margin-bottom: 0.5rem">รูปปัจจุบัน:</p>
                        <img
                            src="{{ $member->photo_url }}"
                            class="photo-preview"
                            onerror="
                                this.src =
                                    'https://ui-avatars.com/api/?name={{ urlencode($member->name_en) }}&background=720A00&color=fff&size=100'
                            "
                        />
                    @endif

                    <div class="form-group">
                        <label class="form-label">อัพโหลดรูปใหม่ {{ $member ? '(ไม่บังคับ ถ้าไม่อัพโหลดจะใช้รูปเดิม)' : '' }}</label>
                        <input type="file" name="photo" class="form-input" accept="image/*" style="padding: 0.5rem" />
                        <p style="font-size: 0.73rem; color: var(--muted); margin-top: 0.3rem">ขนาดสูงสุด 2MB · JPG, PNG, WEBP</p>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="gap-4 flex items-center">
                    <button type="submit" class="btn-primary">
                        {{ $member ? '💾 บันทึกการแก้ไข' : '➕ เพิ่มอาจารย์' }}
                    </button>
                    <a href="{{ route('admin.faculty.index') }}" class="btn-outline">ยกเลิก</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let eduIndex = document.querySelectorAll('.education-block').length;

        function addEducation() {
            const container = document.getElementById('educations-container');
            const html = `
            <div class="education-block">
                <button type="button" class="btn-remove-edu" onclick="removeEducation(this)">✕ ลบ</button>
                <div class="edu-grid">
                    <input type="text" name="educations[${eduIndex}][degree]"     placeholder="Degree (e.g. Ph.D., M.Sc., B.Eng.)"         class="full-width" />
                    <input type="text" name="educations[${eduIndex}][field]"      placeholder="Field of Study (e.g. Computer Engineering)"  class="full-width" />
                    <input type="text" name="educations[${eduIndex}][university]" placeholder="University" />
                    <input type="text" name="educations[${eduIndex}][country]"    placeholder="Country" />
                    <input type="text" name="educations[${eduIndex}][year]"       placeholder="Year (e.g. 2015)" />
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
            eduIndex++;
        }

        function removeEducation(btn) {
            btn.closest('.education-block').remove();
        }
    </script>
@endpush
