<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{
    public function index(): View
    {
        $users = User::all();
        return view('pages.member.index', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('pages.member.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $this->redirectBack([
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
