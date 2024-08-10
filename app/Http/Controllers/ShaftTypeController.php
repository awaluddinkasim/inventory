<?php

namespace App\Http\Controllers;

use App\Models\ShaftType;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;

class ShaftTypeController extends BaseController
{
    public function index(): View
    {
        return view('pages.shaft.type', [
            'brands' => ShaftType::groupBy('brand')->pluck('brand'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'brand' => 'required',
            'name' => 'required',
            'url' => 'nullable',
        ]);

        ShaftType::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft type created successfully',
        ]);
    }

    public function update(Request $request, ShaftType $type): RedirectResponse
    {
        $data = $request->validate([
            'brand' => 'required',
            'name' => 'required',
            'url' => 'nullable',
        ]);

        $type->update($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft type updated successfully',
        ]);
    }

    public function destroy(ShaftType $type): RedirectResponse
    {
        $type->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft type deleted successfully',
        ]);
    }
}
