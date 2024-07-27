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
        $data['password'] = bcrypt($data['password']);
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
            $data['password'] = bcrypt($data['password']);
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
        $user->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data deleted successfully',
        ]);
    }
}
