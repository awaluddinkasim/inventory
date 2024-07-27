<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GripController extends BaseController
{
    public function index(): View
    {
        $grips = Grip::all();
        return view('pages.grip.index', compact('grips'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id_model' => 'required',
            'size' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'core_size' => 'required',
            'wholesale' => 'required|numeric',
            'percent' => 'required|numeric',
        ]);

        Grip::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip data created successfully',
        ]);
    }

    public function show(Grip $grip): View
    {
        return view('pages.grip.show', compact('grip'));
    }

    public function edit(Grip $grip): View
    {
        return view('pages.grip.edit', compact('grip'));
    }

    public function update(Request $request, Grip $grip): RedirectResponse
    {
        $data = $request->validate([
            'id_model' => 'required',
            'size' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'core_size' => 'required',
            'wholesale' => 'required|numeric',
            'percent' => 'required|numeric',
        ]);

        $grip->update($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip data updated successfully',
        ]);
    }

    public function destroy(Grip $grip): RedirectResponse
    {
        $grip->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip data deleted successfully',
        ]);
    }
}
