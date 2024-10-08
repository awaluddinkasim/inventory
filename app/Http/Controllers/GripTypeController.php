<?php

namespace App\Http\Controllers;

use App\Models\GripType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GripTypeController extends BaseController
{
    public function index(): View
    {
        return view('pages.grip.type', [
            'brands' => GripType::groupBy('brand')->pluck('brand'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'brand' => 'required',
            'name' => 'required',
        ]);

        GripType::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip type created successfully',
        ]);
    }

    public function update(Request $request, GripType $type): RedirectResponse
    {
        $data = $request->validate([
            'brand' => 'required',
            'name' => 'required',
        ]);

        $type->update($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip type updated successfully',
        ]);
    }

    public function destroy(GripType $type): RedirectResponse
    {
        $type->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip type deleted successfully',
        ]);
    }
}
