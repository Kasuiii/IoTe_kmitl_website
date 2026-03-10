<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin dashboard — shows all users
    public function index()
    {
        $allUsers   = User::all();
        $adminCount = User::where('role', 'admin')->count();
        $memberCount = User::where('role', 'member')->count();

        return view('dashboard.admin', compact('allUsers', 'adminCount', 'memberCount'));
    }

    // Manage users list
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    // Promote a member to admin
    public function makeAdmin(User $user)
    {
        $user->update(['role' => 'admin']);
        return back()->with('success', "{$user->name} is now an admin.");
    }

    // Demote admin back to member
    public function makeMember(User $user)
    {
        // Prevent self-demotion
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot demote yourself.');
        }

        $user->update(['role' => 'member']);
        return back()->with('success', "{$user->name} is now a member.");
    }
}
