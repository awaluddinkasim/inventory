<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use App\Models\Admin;

class AdminController extends BaseController
{
    public function index(): View
    {
        $admins = Admin::all();
        return view('pages.admin.index', compact('admins'));
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

        Admin::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data created successfully',
        ]);
    }

    public function edit(Admin $admin): View
    {
        return view('pages.admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin): RedirectResponse
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

        $admin->update($data);

        return $this->redirect(route('users'), [
            'status' => 'success',
            'message' => 'User data updated successfully',
        ]);
    }

    public function destroy(Admin $admin): RedirectResponse
    {
        if ($admin->id == auth('admin')->user()->id) {
            return $this->redirectBack([
                'status' => 'error',
                'message' => 'You cannot delete your own account',
            ]);
        }

        $admin->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data deleted successfully',
        ]);
    }

    public function profile(): View
    {
        return view('pages.profile');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'phone' => 'required',
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $admin = Admin::find(auth('admin')->user()->id);
        $admin->update($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'User data updated successfully',
        ]);
    }
}
