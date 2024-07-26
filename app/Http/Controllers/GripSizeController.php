<?php

namespace App\Http\Controllers;

use App\Models\GripSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GripSizeController extends BaseController
{
    public function index(): View
    {
        return view('pages.master.size');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        GripSize::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Size created successfully',
        ]);
    }

    public function destroy(GripSize $size): RedirectResponse
    {
        $size->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Size deleted successfully',
        ]);
    }
}
