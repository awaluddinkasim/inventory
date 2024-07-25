<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends BaseController
{
    public function index(): View
    {
        return view('pages.user.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        User::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data created successfully',
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data deleted successfully',
        ]);
    }
}
