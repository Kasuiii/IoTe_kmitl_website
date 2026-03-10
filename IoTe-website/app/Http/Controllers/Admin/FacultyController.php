<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacultyController extends Controller
{
    // LIST all faculty members 
    public function index()
    {
        $members = FacultyMember::orderBy('sort_order')->orderBy('name_en')->get();
        $grouped = $members->groupBy('role');

        return view('admin.faculty.index', compact('members', 'grouped'));
    }

    // SHOW blank CREATE form 
    public function create()
    {
        return view('admin.faculty.form', ['member' => null]);
    }

    // SAVE new faculty member
    public function store(Request $request)
    {
        $data = $request->validate([
            'prefix'             => 'required|string|max:50',
            'name_th'            => 'required|string|max:255',
            'name_en'            => 'required|string|max:255',
            'role'               => 'required|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:50',
            'research_interests' => 'nullable|string',
            'study_paths'        => 'nullable|string',
            'position'           => 'nullable|in:professor,assoc_prof,asst_prof,lecturer',
            'office_location'    => 'nullable|string|max:255',
            'bio'                => 'nullable|string',
            'is_staff'           => 'boolean',
            'sort_order'         => 'nullable|integer',
            'photo'              => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('faculty', 'public');
            $data['photo_url'] = '/storage/' . $path;
        }

        $data['is_staff'] = $request->boolean('is_staff');

        $faculty = FacultyMember::create($data);

        // Save education rows
        $this->syncEducations($faculty, $request->input('educations', []));

        return redirect()->route('admin.faculty.index')
            ->with('success', 'เพิ่มอาจารย์สำเร็จ!');
    }

    // SHOW pre-filled EDIT form
    public function edit(FacultyMember $faculty)
    {
        return view('admin.faculty.form', ['member' => $faculty]);
    }

    // SAVE edits
    public function update(Request $request, FacultyMember $faculty)
    {
        $data = $request->validate([
            'prefix'             => 'required|string|max:50',
            'name_th'            => 'required|string|max:255',
            'name_en'            => 'required|string|max:255',
            'role'               => 'required|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:50',
            'research_interests' => 'nullable|string',
            'study_paths'        => 'nullable|string',
            'position'           => 'nullable|string|in:professor,assoc_prof,asst_prof,lecturer',
            'office_location'    => 'nullable|string|max:255',
            'bio'                => 'nullable|string',
            'is_staff'           => 'boolean',
            'sort_order'         => 'nullable|integer',
            'photo'              => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($faculty->photo_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $faculty->photo_url));
            }
            $path = $request->file('photo')->store('faculty', 'public');
            $data['photo_url'] = '/storage/' . $path;
        }

        $data['is_staff'] = $request->boolean('is_staff');

        $faculty->update($data);

        $this->syncEducations($faculty, $request->input('educations', []));

        return redirect()->route('admin.faculty.index')
            ->with('success', 'แก้ไขข้อมูลอาจารย์สำเร็จ!');
    }

    // DELETE 
    public function destroy(FacultyMember $faculty)
    {
        if ($faculty->photo_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $faculty->photo_url));
        }

        $faculty->educations()->delete();
        $faculty->delete();

        return redirect()->route('admin.faculty.index')
            ->with('success', 'ลบข้อมูลอาจารย์สำเร็จ!');
    }

    private function syncEducations(FacultyMember $faculty, array $educations): void
    {
        $faculty->educations()->delete();

        foreach ($educations as $index => $edu) {
            if (empty($edu['degree']) && empty($edu['university'])) {
                continue;
            }

            $faculty->educations()->create([
                'degree'     => $edu['degree']     ?? null,
                'field'      => $edu['field']      ?? null,
                'university' => $edu['university'] ?? null,
                'country'    => $edu['country']    ?? null,
                'year'       => $edu['year']       ?? null,
                'sort_order' => $index,
            ]);
        }
    }
}
