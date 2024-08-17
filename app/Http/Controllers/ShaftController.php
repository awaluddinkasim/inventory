<?php

namespace App\Http\Controllers;

use App\Exports\ShaftsExport;
use App\Models\Shaft;
use App\Models\ShaftType;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use App\Models\ShaftImage;
use Maatwebsite\Excel\Facades\Excel;

class ShaftController extends BaseController
{
    public function list(): View
    {
        return view('pages.shaft.list', [
            'types' => ShaftType::all(),
            'flexes' => Shaft::groupBy('flex')->pluck('flex'),
            'shafts' => Shaft::with(['type'])->orderBy('type_id')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type_id' => 'required',
            'shaft' => 'required',
            'flex' => 'required',
            'length' => 'required',
            'weight' => 'required',
            'wholesale' => 'required',
            'percent' => 'required',
            'img' => 'required|image',
        ]);

        $check = Shaft::where('type_id', $data['type_id'])->where('shaft', $data['shaft'])->first();
        if ($check) {
            return $this->redirectBack([
                'status' => 'error',
                'message' => 'Shaft with the same type and name already exists',
            ]);
        }

        $type = ShaftType::find($data['type_id']);

        if (str_starts_with($data['shaft'], '-')) {
            $data['shaft'] = $type->name . $data['shaft'];
        } else {
            $data['shaft'] = $type->name . ' ' . $data['shaft'];
        }

        $data['code'] = generateShaftCode($data['flex'], $data['type_id']);
        $data['length'] = convertToNumber($data['length']);
        $data['weight'] = convertToNumber($data['weight']);
        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);
        $data['retail'] = round($data['wholesale'] + ($data['wholesale'] * $data['percent'] / 100), -3);

        $shaft = Shaft::create($data);

        $file = $request->file('img');
        $filename = $data['code'] . '.' . $file->extension();
        $file->move(public_path('img/shafts'), $filename);

        $image = new ShaftImage();
        $image->shaft_id = $shaft->id;
        $image->filename = $filename;
        $image->save();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft created successfully',
        ]);
    }

    public function show(Shaft $shaft): View
    {
        return view('pages.shaft.show', [
            'shaft' => $shaft,
        ]);
    }

    public function edit(Shaft $shaft): View
    {
        return view('pages.shaft.edit', [
            'types' => ShaftType::all(),
            'flexes' => Shaft::groupBy('flex')->pluck('flex'),
            'shaft' => $shaft,
        ]);
    }

    public function update(Request $request, Shaft $shaft): RedirectResponse
    {
        $data = $request->validate([
            'type_id' => 'required',
            'shaft' => 'required',
            'flex' => 'required',
            'length' => 'required',
            'weight' => 'required',
            'wholesale' => 'required',
            'percent' => 'required',
        ]);

        $check = Shaft::where('type_id', $data['type_id'])->where('shaft', $data['shaft'])->first();
        if ($check) {
            return $this->redirectBack([
                'status' => 'error',
                'message' => 'Shaft with the same type and name already exists',
            ]);
        }

        $type = ShaftType::find($data['type_id']);

        if (str_starts_with($data['shaft'], '-')) {
            $data['shaft'] = $type->name . $data['shaft'];
        } else {
            $data['shaft'] = $type->name . ' ' . $data['shaft'];
        }

        $data['length'] = convertToNumber($data['length']);
        $data['weight'] = convertToNumber($data['weight']);
        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);
        $data['retail'] = round($data['wholesale'] + ($data['wholesale'] * $data['percent'] / 100), -3);

        $shaft->update($data);

        return $this->redirect(route('shaft.list.show', $shaft->code), [
            'status' => 'success',
            'message' => 'Shaft updated successfully',
        ]);
    }

    public function destroy(Shaft $shaft): RedirectResponse
    {
        foreach ($shaft->images as $image) {
            File::delete(public_path('img/shafts/' . $image->filename));
        }

        $shaft->delete();

        return $this->redirect(route('shaft.list'), [
            'status' => 'success',
            'message' => 'Shaft deleted successfully',
        ]);
    }

    public function export()
    {
        return Excel::download(new ShaftsExport, 'shafts-' . date('Y-m-d') . ' ' . time() . '.xlsx');
    }

    public function barcode(): View
    {
        return view('pages.shaft.barcode');
    }
}
