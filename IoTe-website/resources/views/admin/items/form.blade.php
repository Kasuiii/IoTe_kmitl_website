@extends('layouts.app')
@section('title', $item ? 'Edit — ' . $item->name : 'Add Equipment')

@section('content')
    <section class="contact-hero">
        <div class="max-w-4xl px-6 py-6 mx-auto">
            <h1 style="color: var(--crimson); font-size: 2.2rem; font-weight: 800; margin: 0">
                {{ $item ? 'Edit: ' . $item->name : 'Add New Equipment' }}
            </h1>
            <p style="color: var(--crimson); margin-top: 0.5rem; font-size: 0.9rem">
                {{ $item ? 'Update item details, availability, and access settings.' : 'Fill in the details to list a new reservable item.' }}
            </p>
        </div>
    </section>

    <section style="padding: 3.5rem 0 5rem">
        <div class="max-w-4xl px-6 mx-auto">
            {{-- Validation errors --}}
            @if ($errors->any())
                <div
                    style="
                        background: #fef2f2;
                        border: 1px solid #fecaca;
                        border-radius: 0.75rem;
                        padding: 1rem 1.25rem;
                        margin-bottom: 1.75rem;
                    "
                >
                    <p style="font-weight: 700; color: #991b1b; margin: 0 0 0.5rem; font-size: 0.9rem">Please fix these errors:</p>
                    <ul style="list-style: disc; padding-left: 1.25rem; margin: 0; font-size: 0.875rem; color: #b91c1c">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ $item ? route('admin.items.update', $item) : route('admin.items.store') }}"
                enctype="multipart/form-data"
            >
                @csrf
                @if ($item)
                    @method('PUT')
                @endif

                {{-- Card: Basic info --}}
                <div
                    style="
                        background: white;
                        border-radius: 1rem;
                        box-shadow: 0 1px 8px rgba(0, 0, 0, 0.07);
                        padding: 2rem;
                        margin-bottom: 1.5rem;
                    "
                >
                    <h2
                        style="
                            font-size: 1rem;
                            font-weight: 700;
                            color: #1e293b;
                            margin: 0 0 1.5rem;
                            padding-bottom: 0.75rem;
                            border-bottom: 1px solid #f1f5f9;
                        "
                    >
                        Basic Information
                    </h2>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem">
                        {{-- Name --}}
                        <div style="grid-column: 1/-1">
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem">
                                Item Name
                                <span style="color: #dc2626">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $item?->name) }}"
                                placeholder="e.g. ESP32 DevKit V1"
                                style="
                                    width: 100%;
                                    padding: 0.6rem 0.85rem;
                                    border: 1px solid {{ $errors->has('name') ? '#dc2626' : '#e2e8f0' }};
                                    border-radius: 0.5rem;
                                    font-size: 0.9rem;
                                    color: #1e293b;
                                    outline: none;
                                    box-sizing: border-box;
                                "
                            />
                            @error('name')
                                <p style="color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem">
                                Category
                                <span style="color: #dc2626">*</span>
                            </label>
                            <input
                                type="text"
                                name="category"
                                value="{{ old('category', $item?->category) }}"
                                placeholder="e.g. Microcontroller"
                                style="
                                    width: 100%;
                                    padding: 0.6rem 0.85rem;
                                    border: 1px solid {{ $errors->has('category') ? '#dc2626' : '#e2e8f0' }};
                                    border-radius: 0.5rem;
                                    font-size: 0.9rem;
                                    color: #1e293b;
                                    outline: none;
                                    box-sizing: border-box;
                                "
                            />
                            @error('category')
                                <p style="color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Faculty access --}}
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem">
                                Faculty Access
                                <span style="color: #dc2626">*</span>
                            </label>
                            <select
                                name="faculty_access"
                                style="
                                    width: 100%;
                                    padding: 0.6rem 0.85rem;
                                    border: 1px solid #e2e8f0;
                                    border-radius: 0.5rem;
                                    font-size: 0.9rem;
                                    color: #1e293b;
                                    background: white;
                                    box-sizing: border-box;
                                "
                            >
                                @foreach (['all' => 'All Faculties', 'engineering' => 'Engineering Only (01)', 'science' => 'Science Only (05)'] as $val => $label)
                                    <option
                                        value="{{ $val }}"
                                        {{ old('faculty_access', $item?->faculty_access ?? 'all') === $val ? 'selected' : '' }}
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('faculty_access')
                                <p style="color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div style="grid-column: 1/-1">
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem">
                                Description
                                <span style="font-weight: 400; color: #94a3b8">(optional)</span>
                            </label>
                            <textarea
                                name="description"
                                rows="3"
                                placeholder="Short description of the item and its use..."
                                style="
                                    width: 100%;
                                    padding: 0.6rem 0.85rem;
                                    border: 1px solid #e2e8f0;
                                    border-radius: 0.5rem;
                                    font-size: 0.9rem;
                                    color: #1e293b;
                                    resize: vertical;
                                    box-sizing: border-box;
                                "
                            >
{{ old('description', $item?->description) }}</textarea
                            >
                        </div>
                    </div>
                </div>

                {{-- ── Card: Quantity & Loan settings ──────────────────── --}}
                <div
                    style="
                        background: white;
                        border-radius: 1rem;
                        box-shadow: 0 1px 8px rgba(0, 0, 0, 0.07);
                        padding: 2rem;
                        margin-bottom: 1.5rem;
                    "
                >
                    <h2
                        style="
                            font-size: 1rem;
                            font-weight: 700;
                            color: #1e293b;
                            margin: 0 0 1.5rem;
                            padding-bottom: 0.75rem;
                            border-bottom: 1px solid #f1f5f9;
                        "
                    >
                        Stock & Loan Rules
                    </h2>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem">
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem">
                                Total Quantity
                                <span style="color: #dc2626">*</span>
                            </label>
                            <input
                                type="number"
                                name="quantity_total"
                                min="1"
                                value="{{ old('quantity_total', $item?->quantity_total ?? 1) }}"
                                style="
                                    width: 100%;
                                    padding: 0.6rem 0.85rem;
                                    border: 1px solid {{ $errors->has('quantity_total') ? '#dc2626' : '#e2e8f0' }};
                                    border-radius: 0.5rem;
                                    font-size: 0.9rem;
                                    color: #1e293b;
                                    box-sizing: border-box;
                                "
                            />
                            <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.3rem">How many units you own in total.</p>
                            @error('quantity_total')
                                <p style="color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem">
                                Max Borrow Days
                                <span style="color: #dc2626">*</span>
                            </label>
                            <input
                                type="number"
                                name="max_borrow_days"
                                min="1"
                                max="30"
                                value="{{ old('max_borrow_days', $item?->max_borrow_days ?? 7) }}"
                                style="
                                    width: 100%;
                                    padding: 0.6rem 0.85rem;
                                    border: 1px solid {{ $errors->has('max_borrow_days') ? '#dc2626' : '#e2e8f0' }};
                                    border-radius: 0.5rem;
                                    font-size: 0.9rem;
                                    color: #1e293b;
                                    box-sizing: border-box;
                                "
                            />
                            <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.3rem">Maximum loan duration (1–30 days).</p>
                            @error('max_borrow_days')
                                <p style="color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ── Card: Image & Visibility ─────────────────────────── --}}
                <div
                    style="
                        background: white;
                        border-radius: 1rem;
                        box-shadow: 0 1px 8px rgba(0, 0, 0, 0.07);
                        padding: 2rem;
                        margin-bottom: 1.5rem;
                    "
                >
                    <h2
                        style="
                            font-size: 1rem;
                            font-weight: 700;
                            color: #1e293b;
                            margin: 0 0 1.5rem;
                            padding-bottom: 0.75rem;
                            border-bottom: 1px solid #f1f5f9;
                        "
                    >
                        Image & Visibility
                    </h2>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start">
                        {{-- Image upload --}}
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem">
                                Item Photo
                                <span style="font-weight: 400; color: #94a3b8">(optional, max 2 MB)</span>
                            </label>

                            @if ($item && $item->image_url)
                                <div style="margin-bottom: 0.75rem">
                                    <img
                                        src="{{ $item->image_url }}"
                                        alt="{{ $item->name }}"
                                        style="
                                            width: 120px;
                                            height: 80px;
                                            object-fit: cover;
                                            border-radius: 0.5rem;
                                            border: 1px solid #e2e8f0;
                                        "
                                    />
                                    <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.3rem">
                                        Current image — upload a new one to replace it.
                                    </p>
                                </div>
                            @endif

                            <input type="file" name="image" accept="image/*" style="width: 100%; font-size: 0.85rem; color: #475569" />
                            @error('image')
                                <p style="color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Active toggle --}}
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.85rem">
                                Listing Visibility
                            </label>

                            <label
                                style="
                                    display: flex;
                                    align-items: center;
                                    gap: 0.75rem;
                                    cursor: pointer;
                                    background: #f8fafc;
                                    border: 1px solid #e2e8f0;
                                    border-radius: 0.65rem;
                                    padding: 1rem;
                                "
                            >
                                <input type="hidden" name="is_active" value="0" />
                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', $item?->is_active ?? true) ? 'checked' : '' }}
                                    style="width: 18px; height: 18px; accent-color: var(--crimson); cursor: pointer"
                                />
                                <div>
                                    <div style="font-size: 0.88rem; font-weight: 700; color: #1e293b">Show to students</div>
                                    <div style="font-size: 0.78rem; color: #94a3b8; margin-top: 0.1rem">
                                        Uncheck to hide without deleting.
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div style="display: flex; gap: 0.85rem; justify-content: flex-end">
                    <a
                        href="{{ route('admin.items.index') }}"
                        style="
                            padding: 0.7rem 1.75rem;
                            border-radius: 0.5rem;
                            font-weight: 600;
                            font-size: 0.9rem;
                            background: #f1f5f9;
                            color: #475569;
                            text-decoration: none;
                        "
                        onmouseover="this.style.background = '#e2e8f0'"
                        onmouseout="this.style.background = '#f1f5f9'"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        style="
                            padding: 0.7rem 2rem;
                            border-radius: 0.5rem;
                            font-weight: 700;
                            font-size: 0.9rem;
                            background: var(--crimson);
                            color: white;
                            border: none;
                            cursor: pointer;
                        "
                        onmouseover="this.style.opacity = '0.88'"
                        onmouseout="this.style.opacity = '1'"
                    >
                        {{ $item ? 'Save Changes' : 'Add Equipment' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
