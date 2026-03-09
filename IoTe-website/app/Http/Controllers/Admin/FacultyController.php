<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// HOW CONTROLLERS WORK:
// A controller is a PHP class that receives the HTTP request (GET/POST etc.)
// and decides what to do: show a page, save to DB, redirect etc.
//
// CRUD = Create, Read, Update, Delete
// index()   → READ all   → shows list page
// create()  → shows the blank form to CREATE
// store()   → saves the CREATE form submission
// edit()    → shows form pre-filled for UPDATE
// update()  → saves the UPDATE form submission
// destroy() → DELETE

class FacultyController extends Controller
{
    // ── LIST all faculty members ───────────────────────────────
    public function index()
    {
        // orderBy('sort_order') so admin can control display order
        $members = FacultyMember::orderBy('sort_order')->orderBy('name_en')->get();

        // Group them by role for a cleaner admin view
        $grouped = $members->groupBy('role');

        return view('admin.faculty.index', compact('members', 'grouped'));
    }

    // ── SHOW blank CREATE form ──────────────────────────────────
    public function create()
    {
        return view('admin.faculty.form', ['member' => null]);
    }

    // ── SAVE new faculty member ─────────────────────────────────
    public function store(Request $request)
    {
        // validate() checks the input BEFORE we touch the database
        // If validation fails, it automatically redirects back with errors
        $data = $request->validate([
            'prefix'              => 'required|string|max:50',
            'name_th'             => 'required|string|max:255',
            'name_en'             => 'required|string|max:255',
            'role'                => 'required|in:professor,assoc_prof,asst_prof,lecturer',
            'email'               => 'nullable|email|max:255',
            'phone'               => 'nullable|string|max:50',
            'research_interests'  => 'nullable|string',
            'study_paths'         => 'nullable|string',
            'position'            => 'nullable|string|max:255',
            'office_location'     => 'nullable|string|max:255',
            'bio'                 => 'nullable|string',
            'is_staff'            => 'boolean',
            'sort_order'          => 'nullable|integer',
            'photo'               => 'nullable|image|max:2048', // max 2MB image upload
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('faculty', 'public');
            $data['photo_url'] = $path; // store only faculty/filename.jpg
        }

        $data['is_staff'] = $request->boolean('is_staff');

        $faculty = FacultyMember::create($data);
        if ($request->educations) {

            foreach ($request->educations as $index => $edu) {

                if (!$edu['degree'] && !$edu['university']) {
                    continue;
                }

                $faculty->educations()->create([
                    'degree' => $edu['degree'],
                    'field' => $edu['field'],
                    'university' => $edu['university'],
                    'country' => $edu['country'],
                    'year' => $edu['year'],
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('admin.faculty.index')
            ->with('success', 'เพิ่มอาจารย์สำเร็จ!');
    }

    // ── SHOW pre-filled EDIT form ───────────────────────────────
    public function edit(FacultyMember $faculty)
    {
        return view('admin.faculty.form', ['member' => $faculty]);
    }

    // ── SAVE edits ──────────────────────────────────────────────
    public function update(Request $request, FacultyMember $faculty)
    {
        $data = $request->validate([
            'prefix'              => 'required|string|max:50',
            'name_th'             => 'required|string|max:255',
            'name_en'             => 'required|string|max:255',
            'role'                => 'required|in:professor,assoc_prof,asst_prof,lecturer',
            'email'               => 'nullable|email|max:255',
            'phone'               => 'nullable|string|max:50',
            'research_interests'  => 'nullable|string',
            'study_paths'         => 'nullable|string',
            'position'            => 'nullable|string|max:255',
            'office_location'     => 'nullable|string|max:255',
            'bio'                 => 'nullable|string',
            'is_staff'            => 'boolean',
            'sort_order'          => 'nullable|integer',
            'photo'               => 'nullable|image|max:2048',
        ]);

        // If a new photo is uploaded, delete the old one to save disk space
        if ($request->hasFile('photo')) {
            if ($faculty->photo_url) {
                $oldPath = str_replace('/storage/', '', $faculty->photo_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo')->store('faculty', 'public');
            $data['photo_url'] = '/storage/' . $path;
        }

        $data['is_staff'] = $request->boolean('is_staff');

        $faculty->update($data);

        return redirect()->route('admin.faculty.index')
            ->with('success', 'แก้ไขข้อมูลอาจารย์สำเร็จ!');
    }

    // DELETE
    public function destroy(FacultyMember $faculty)
    {
        // Delete the photo file from disk too
        if ($faculty->photo_url) {
            $oldPath = str_replace('/storage/', '', $faculty->photo_url);
            Storage::disk('public')->delete($oldPath);
        }

        $faculty->delete();

        return redirect()->route('admin.faculty.index')
            ->with('success', 'ลบข้อมูลอาจารย์สำเร็จ!');
    }
}
