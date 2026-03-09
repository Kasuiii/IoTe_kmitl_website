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
            {{-- enctype="multipart/form-data" is REQUIRED for file uploads --}}
            <form
                method="POST"
                action="{{ $member ? route('admin.faculty.update', ['faculty' => $member->id]) : route('admin.faculty.store') }}"
                enctype="multipart/form-data"
            >
                @csrf
                {{-- PUT method because HTML forms only support GET/POST --}}
                @if ($member)
                    @method('PUT')
                @endif

                {{-- SECTION 1: Basic Info --}}
                <div class="form-card">
                    <div class="form-section-title">👤 ข้อมูลพื้นฐาน</div>
                    <div class="md:grid-cols-3 gap-4 grid grid-cols-1">
                        <div class="form-group">
                            <label class="form-label">คำนำหน้า (Prefix) *</label>
                            {{-- old() = re-fills value if validation fails --}}
                            <input
                                type="text"
                                name="prefix"
                                class="form-input @error('prefix') error @endif"
                                value="{{ old('prefix', $member?->prefix) }}"
                                placeholder="ผศ.ดร. / รศ.ดร."
                                required
                            />
                            @error('prefix')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label">ชื่อภาษาไทย *</label>
                            <input
                                type="text"
                                name="name_th"
                                class="form-input @error('name_th') error @endif"
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
                                class="form-input @error('name_en') error @endif"
                                value="{{ old('name_en', $member?->name_en) }}"
                                required
                            />
                            @error('name_en')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role *</label>
                            <select name="role" class="form-input">
                                @foreach (['professor' => 'ศาสตราจารย์ (Professor)', 'assoc_prof' => 'รองศาสตราจารย์ (Assoc.)', 'asst_prof' => 'ผู้ช่วยศาสตราจารย์ (Asst.)', 'lecturer' => 'อาจารย์ (Lecturer)'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('role', $member?->role) === $val ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">ตำแหน่งพิเศษ (Position)</label>
                            <input
                                type="text"
                                name="position"
                                class="form-input"
                                value="{{ old('position', $member?->position) }}"
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
                                class="form-input @error('email') error @endif"
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
                {{-- SECTION 3: Education --}}
                    <div class="form-card">
                        <div class="form-section-title">🎓 ประวัติการศึกษา</div>
                        <div id="educations-container" class="gap-4 flex flex-col">
                            @php
                                $educations = old('educations', $member ? $member->educations->toArray() : []);
                            @endphp
                            @foreach ($educations as $index => $edu)
                                <div class="education-block" data-index="{{ $index }}">
                                    <div class="gap-2 flex flex-wrap">
                                        <input type="text" name="educations[{{ $index }}][degree]" placeholder="Degree (ex. B.Sc. Computer Science)" value="{{ $edu['degree'] ?? '' }}" class="form-input" />
                                        <input type="text" name="educations[{{ $index }}][field]" placeholder="Field of Study" value="{{ $edu['field'] ?? '' }}" class="form-input" />
                                        <input type="text" name="educations[{{ $index }}][university]" placeholder="University" value="{{ $edu['university'] ?? '' }}" class="form-input" />
                                        <input type="text" name="educations[{{ $index }}][country]" placeholder="Country" value="{{ $edu['country'] ?? '' }}" class="form-input" />
                                        <input type="text" name="educations[{{ $index }}][year]" placeholder="Year" value="{{ $edu['year'] ?? '' }}" class="form-input" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- SECTION 3: Research --}}
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
                            ตัวอย่าง: IoT Security, Edge AI, Smart Grid — จะแสดงเป็น tag บนหน้าเว็บ
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
                    <div class="form-group">
                        <label>Study Path</label>

                        <div class="study-block">
                            <label>Undergraduate</label>
                            <input type="text" name="study_undergrad_degree" placeholder="Degree (ex. B.Sc. Computer Science)" />
                            <input type="text" name="study_undergrad_university" placeholder="University" />
                            <input type="text" name="study_undergrad_country" placeholder="Country" />
                            <input type="text" name="study_undergrad_year" placeholder="Year" />
                        </div>

                        <div class="study-block">
                            <label>Master</label>
                            <input type="text" name="study_master_degree" placeholder="Degree" />
                            <input type="text" name="study_master_university" placeholder="University" />
                            <input type="text" name="study_master_country" placeholder="Country" />
                            <input type="text" name="study_master_year" placeholder="Year" />
                        </div>

                        <div class="study-block">
                            <label>Doctoral</label>
                            <input type="text" name="study_phd_degree" placeholder="Degree" />
                            <input type="text" name="study_phd_university" placeholder="University" />
                            <input type="text" name="study_phd_country" placeholder="Country" />
                            <input type="text" name="study_phd_year" placeholder="Year" />
                        </div>
                    </div>
                </div>

                {{-- SECTION 4: Photo --}}
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

                {{-- Submit buttons --}}
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
@push('script')
    <script>

        let eduIndex = 1;

        function addEducation() {
        
            const wrapper = document.getElementById('education-wrapper');
        
            const html = `
                <div class="education-row">
                
                    <input type="text" name="educations[${eduIndex}][degree]" placeholder="Degree">
                
                    <input type="text" name="educations[${eduIndex}][field]" placeholder="Field">
                
                    <input type="text" name="educations[${eduIndex}][university]" placeholder="University">
                
                    <input type="text" name="educations[${eduIndex}][country]" placeholder="Country">
                
                    <input type="text" name="educations[${eduIndex}][year]" placeholder="Year">
                
                </div>
            `;
            
            wrapper.insertAdjacentHTML('beforeend', html);
            
            eduIndex++;
            
        }

    </script>
@endpush