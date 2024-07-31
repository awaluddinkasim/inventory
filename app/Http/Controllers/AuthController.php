<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends BaseController
{
    public function login(): View
    {
        return view('auth');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            $request->session()->regenerate();

            $user = User::find(Auth::user()->id);
            $user->last_login = now();
            $user->update();

            return redirect()->intended(route('dashboard'));
        }

        return $this->redirectBack([
            'status' => 'error',
            'message' => 'Credentials do not match',
        ], true);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->redirect(route('login'), [
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }
}
