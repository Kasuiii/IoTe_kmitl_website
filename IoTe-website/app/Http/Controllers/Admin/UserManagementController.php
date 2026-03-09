<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        // Get all users with student info parsed
        $users = User::orderBy('created_at', 'desc')->get();

        // Count stats
        $stats = [
            'total'       => $users->count(),
            'admins'      => $users->where('role', 'admin')->count(),
            'engineering' => $users->filter(fn($u) => $u->faculty_code === '01')->count(),
            'science'     => $users->filter(fn($u) => $u->faculty_code === '05')->count(),
            'other'       => $users->filter(fn($u) => !$u->is_student)->count(),
        ];

        // Group students by year for a useful breakdown
        $byYear = $users->filter(fn($u) => $u->is_student)
            ->groupBy(fn($u) => 'Year ' . $u->student_year);

        return view('admin.users.index', compact('users', 'stats', 'byYear'));
    }

    // Change a user's role (e.g. promote to admin)
    public function updateRole(\Illuminate\Http\Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,user']);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'อัปเดต Role สำเร็จ!');
    }
}
