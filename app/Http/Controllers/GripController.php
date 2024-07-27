<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use App\Models\GripModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GripController extends BaseController
{
    public function index(): View
    {

        $data =[
            'grips' => Grip::all(),
            'models' => GripModel::all()

        ];
        return view('pages.grip.index', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'model_id' => 'required',
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
        $data =[
            'grip' => $grip,
            'models' => GripModel::all()

        ];

        return view('pages.grip.show', $data);
    }

    public function edit(Grip $grip): View
    {
        $data =[
            'grip' => $grip,
            'models' => GripModel::all()

        ];
        return view('pages.grip.edit', $data);
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

        return $this->redirect( route('grips') ,[
            'status' => 'success',
            'message' => 'Grip data deleted successfully',
        ]);
    }
}
