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
        return view('pages.grip.index', [
            'models' => GripModel::all(),
            'grips' => Grip::with(['model'])->get(),
            'sizes' => Grip::groupBy('size')->pluck('size'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'model_id' => 'required',
            'size' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'core_size' => 'required',
            'wholesale' => 'required',
            'percent' => 'required',
        ]);

        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);

        Grip::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip data created successfully',
        ]);
    }

    public function show(Grip $grip): View
    {
        $data = [
            'grip' => $grip,
            'models' => GripModel::all()
        ];

        return view('pages.grip.show', $data);
    }

    public function edit(Grip $grip): View
    {
        return view('pages.grip.edit', [
            'models' => GripModel::all(),
            'grip' => $grip,
            'sizes' => Grip::groupBy('size')->pluck('size'),
        ]);
    }

    public function update(Request $request, Grip $grip): RedirectResponse
    {
        $data = $request->validate([
            'model_id' => 'required',
            'size' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'core_size' => 'required',
            'wholesale' => 'required',
            'percent' => 'required',
        ]);

        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);

        $grip->update($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip data updated successfully',
        ]);
    }

    public function destroy(Grip $grip): RedirectResponse
    {
        $grip->delete();

        return $this->redirect(route('grips'), [
            'status' => 'success',
            'message' => 'Grip data deleted successfully',
        ]);
    }
}
