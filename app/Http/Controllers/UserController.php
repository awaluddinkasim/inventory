<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends BaseController
{
    public function index(): View
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
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

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data created successfully',
        ]);
    }

    public function edit(User $user): View
    {
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'phone' => 'required',
            'role' => 'required',
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $this->redirect(route('users'), [
            'status' => 'success',
            'message' => 'User data updated successfully',
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id == auth()->user()->id) {
            return $this->redirectBack([
                'status' => 'error',
                'message' => 'You cannot delete your own account',
            ]);
        }

        $user->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data deleted successfully',
        ]);
    }
}
