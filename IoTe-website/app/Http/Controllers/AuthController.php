<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('dashboard.admin', compact('user'));
        }

        return view('dashboard.index', compact('user'));
    }
}
