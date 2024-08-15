<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use App\Models\GripImage;
use App\Models\GripModel;
use Illuminate\View\View;
use App\Exports\GripsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;

class GripController extends BaseController
{
    public function list(): View
    {
        return view('pages.grip.list', [
            'models' => GripModel::all(),
            'sizes' => Grip::groupBy('size')->pluck('size'),
            'grips' => Grip::with(['model'])->get()
                ->sortBy(fn($grip) => $grip->size)
                ->sortBy(fn($grip) => $grip->model_id)
                ->sortBy(fn($grip) => $grip->model->type_id)
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

        $data['code'] = generateGripCode($data['color'], $data['model_id'], $data['size']);
        $data['weight'] = convertToNumber($data['weight']);
        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);
        $data['retail'] = round($data['wholesale'] + ($data['wholesale'] * $data['percent'] / 100), -3);

        $grip = Grip::create($data);

        $file = $request->file('img');
        $filename = $data['code'] . '-' . time() . '.' . $file->extension();
        $file->move(public_path('img/grips'), $filename);

        $image = new GripImage();
        $image->grip_id = $grip->id;
        $image->filename = $filename;
        $image->save();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip data created successfully',
        ]);
    }

    public function show(Grip $grip): View
    {
        return view('pages.grip.show', [
            'grip' => $grip,
        ]);
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
        $data['weight'] = convertToNumber($data['weight']);
        $data['percent'] = convertToNumber($data['percent']);
        $data['retail'] = round($data['wholesale'] + ($data['wholesale'] * $data['percent'] / 100), -3);

        $grip->update($data);

        return $this->redirect(route('grip.list.show', $grip->code), [
            'status' => 'success',
            'message' => 'Grip data updated successfully',
        ]);
    }

    public function destroy(Grip $grip): RedirectResponse
    {
        foreach ($grip->images as $image) {
            File::delete(public_path('img/grips/' . $image->filename));
        }

        $grip->delete();

        return $this->redirect(route('grip.list'), [
            'status' => 'success',
            'message' => 'Grip data deleted successfully',
        ]);
    }

    public function export()
    {
        return Excel::download(new GripsExport, 'grips-data-' . time() . '.xlsx');
    }

    public function barcode(): View
    {
        return view('pages.grip.barcode');
    }
}
