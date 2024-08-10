<?php

namespace App\Http\Controllers;

use App\Models\GripModel;
use App\Models\GripType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GripModelController extends BaseController
{
    public function index(): View
    {
        return view('pages.grip.model', [
            'types' => GripType::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type_id' => 'required',
            'name' => 'required',
            'url' => 'nullable',
        ]);

        GripModel::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Model created successfully',
        ]);
    }

    public function update(Request $request, GripModel $model): RedirectResponse
    {
        $data = $request->validate([
            'type_id' => 'required',
            'name' => 'required',
            'url' => 'nullable',
        ]);

        $model->update($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Model updated successfully',
        ]);
    }

    public function destroy(GripModel $model): RedirectResponse
    {
        $model->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Model deleted successfully',
        ]);
    }
}
