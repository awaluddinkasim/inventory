<?php

namespace App\Http\Controllers;

use App\Models\GripModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GripModelController extends BaseController
{
    public function index(): View
    {
        return view('pages.master.model');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        GripModel::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Model created successfully',
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