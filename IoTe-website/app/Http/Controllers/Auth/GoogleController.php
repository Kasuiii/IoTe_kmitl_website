<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    private string $allowedDomain = 'kmitl.ac.th';

    /**
     * Redirect the user to Google's login page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google redirects back 
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')
                ->with('error', 'Google login failed. Please try again.');
        }

        $email  = $googleUser->getEmail();
        $domain = substr(strrchr($email, "@"), 1);
        $adminEmail = config('services.google.admin_email');
        $role = ($email === $adminEmail) ? 'admin' : 'member';

        if ($domain !== $this->allowedDomain) {
            return redirect('/login')
                ->with('error', "Only @{$this->allowedDomain} accounts are allowed to access this system.");
        }

        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],

            [
                'name'   => $googleUser->getName(),
                'email'  => $email,
                'role'   => $googleUser->getEmail() === config('services.google.admin_email') ? 'admin' : 'member',
                'avatar' => $googleUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')
            ->with('success', 'You have been logged out successfully.');
    }
}
