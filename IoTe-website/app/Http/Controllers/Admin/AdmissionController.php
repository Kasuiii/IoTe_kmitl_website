<?php
// ═══════════════════════════════════════════════════
// FILE: app/Http/Controllers/Admin/AdmissionController.php
// ═══════════════════════════════════════════════════
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionRound;
use App\Models\AdmissionProject;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function index()
    {
        $rounds = AdmissionRound::with('projects')
            ->orderBy('sort_order')
            ->get();
        return view('admin.admission.index', compact('rounds'));
    }

    public function createRound()
    {
        return view('admin.admission.round-form', ['round' => null]);
    }

    public function storeRound(Request $request)
    {
        $data = $request->validate([
            'round_number'   => 'required|integer',
            'round_name'     => 'required|string|max:100',
            'round_name_th'  => 'required|string|max:100',
            'total_seats'    => 'required|integer|min:0',
            'badge_color'    => 'nullable|string',
            'description'    => 'nullable|string',
            'sort_order'     => 'nullable|integer',
        ]);
        AdmissionRound::create($data);
        return redirect()->route('admin.admission.index')->with('success', 'เพิ่มรอบการรับสมัครสำเร็จ!');
    }

    public function editRound(AdmissionRound $round)
    {
        return view('admin.admission.round-form', compact('round'));
    }

    public function updateRound(Request $request, AdmissionRound $round)
    {
        $data = $request->validate([
            'round_number'   => 'required|integer',
            'round_name'     => 'required|string|max:100',
            'round_name_th'  => 'required|string|max:100',
            'total_seats'    => 'required|integer|min:0',
            'badge_color'    => 'nullable|string',
            'description'    => 'nullable|string',
            'sort_order'     => 'nullable|integer',
        ]);
        $round->update($data);
        return redirect()->route('admin.admission.index')->with('success', 'แก้ไขรอบการรับสมัครสำเร็จ!');
    }

    public function destroyRound(AdmissionRound $round)
    {
        $round->delete();
        return redirect()->route('admin.admission.index')->with('success', 'ลบรอบการรับสมัครสำเร็จ!');
    }

    public function createProject(AdmissionRound $round)
    {
        return view('admin.admission.project-form', ['round' => $round, 'project' => null]);
    }

    public function storeProject(Request $request, AdmissionRound $round)
    {
        $data = $request->validate([
            'project_name'    => 'required|string|max:255',
            'project_name_th' => 'required|string|max:255',
            'seats'           => 'required|integer|min:0',
            'requirements'    => 'nullable|string',
            'score_criteria'  => 'nullable|string',
            'gpax_min'        => 'nullable|string',
            'notes'           => 'nullable|string',
            'sort_order'      => 'nullable|integer',
        ]);
        $data['admission_round_id'] = $round->id;
        AdmissionProject::create($data);
        return redirect()->route('admin.admission.index')->with('success', 'เพิ่มโครงการรับสมัครสำเร็จ!');
    }

    public function editProject(AdmissionProject $project)
    {
        $round = $project->round;
        return view('admin.admission.project-form', compact('round', 'project'));
    }

    public function updateProject(Request $request, AdmissionProject $project)
    {
        $data = $request->validate([
            'project_name'    => 'required|string|max:255',
            'project_name_th' => 'required|string|max:255',
            'seats'           => 'required|integer|min:0',
            'requirements'    => 'nullable|string',
            'score_criteria'  => 'nullable|string',
            'gpax_min'        => 'nullable|string',
            'notes'           => 'nullable|string',
            'sort_order'      => 'nullable|integer',
        ]);
        $project->update($data);
        return redirect()->route('admin.admission.index')->with('success', 'แก้ไขโครงการสำเร็จ!');
    }

    public function destroyProject(AdmissionProject $project)
    {
        $project->delete();
        return redirect()->route('admin.admission.index')->with('success', 'ลบโครงการสำเร็จ!');
    }
}
