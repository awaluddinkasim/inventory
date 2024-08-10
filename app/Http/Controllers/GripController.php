<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use App\Models\GripModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class GripController extends BaseController
{
    public function index(): View
    {
        return view('pages.grip.index', [
            'models' => GripModel::all(),
            'sizes' => Grip::groupBy('size')->pluck('size'),
            'grips' => Grip::with(['model'])->get()->sortBy(function ($query) {
                return $query->model->type_id;
            }),
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
            'img' => 'required|image',
        ]);

        $check = Grip::where('model_id', $data['model_id'])->where('color', $data['color'])->where('size', $data['size'])->first();
        if ($check) {
            return $this->redirectBack([
                'status' => 'error',
                'message' => 'Grip model with the same color and size already exists',
            ]);
        }

        $data['code'] = generateCode($data['color'], $data['model_id'], $data['size']);
        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);

        $file = $request->file('img');
        $fileName = $data['code'] . '.' . $file->extension();
        $file->move(public_path('img/grips'), $fileName);
        $data['img'] = $fileName;

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
            'img' => 'nullable|image',
        ]);

        $check = Grip::where('id', '!=', $grip->id)
            ->where('model_id', $data['model_id'])
            ->where('color', $data['color'])
            ->where('size', $data['size'])->first();
        if ($check) {
            return $this->redirectBack([
                'status' => 'error',
                'message' => 'Grip model with the same color and size already exists',
            ]);
        }

        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = $grip->code . '.' . $file->extension();
            $file->move(public_path('img/grips'), $fileName);
            $data['img'] = $fileName;
        }

        $grip->update($data);

        return $this->redirect(route('grips.show', $grip->code), [
            'status' => 'success',
            'message' => 'Grip data updated successfully',
        ]);
    }

    public function destroy(Grip $grip): RedirectResponse
    {
        File::delete(public_path('barcodes/' . $grip->img));

        $grip->delete();

        return $this->redirect(route('grips'), [
            'status' => 'success',
            'message' => 'Grip data deleted successfully',
        ]);
    }
}
