<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $stats = [
            'total'       => $users->count(),
            'admins'      => $users->where('role', 'admin')->count(),
            'engineering' => $users->filter(fn($u) => $u->faculty_code === '01')->count(),
            'science'     => $users->filter(fn($u) => $u->faculty_code === '05')->count(),
            'other'       => $users->filter(fn($u) => !$u->is_student)->count(),
        ];
        $byYear = $users->filter(fn($u) => $u->is_student)
            ->groupBy(fn($u) => 'Year ' . $u->student_year);

        return view('admin.users.index', compact('users', 'stats', 'byYear'));
    }

    public function updateRole(\Illuminate\Http\Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,user']);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'อัปเดต Role สำเร็จ!');
    }
}
