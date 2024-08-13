<?php

namespace App\Http\Controllers;

use App\Models\Shaft;
use App\Models\ShaftType;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;

class ShaftController extends BaseController
{
    public function index(): View
    {
        return view('pages.shaft.index', [
            'types' => ShaftType::all(),
            'shafts' => Shaft::all(),
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

        $data['code'] = generateShaftCode($data['flex'], $data['type_id']);
        $data['length'] = convertToNumber($data['length']);
        $data['weight'] = convertToNumber($data['weight']);
        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);
        $data['retail'] = round($data['wholesale'] + ($data['wholesale'] * $data['percent'] / 100), -3);

        $file = $request->file('img');
        $fileName = $data['code'] . '.' . $file->extension();
        $file->move(public_path('img/shafts'), $fileName);
        $data['img'] = $fileName;

        Shaft::create($data);

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
            'img' => 'nullable|image',
        ]);

        $check = Shaft::where('type_id', $data['type_id'])->where('shaft', $data['shaft'])->first();
        if ($check) {
            return $this->redirectBack([
                'status' => 'error',
                'message' => 'Shaft with the same type and name already exists',
            ]);
        }

        $data['length'] = convertToNumber($data['length']);
        $data['weight'] = convertToNumber($data['weight']);
        $data['wholesale'] = convertToNumber($data['wholesale']);
        $data['percent'] = convertToNumber($data['percent']);
        $data['retail'] = round($data['wholesale'] + ($data['wholesale'] * $data['percent'] / 100), -3);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = $data['code'] . '.' . $file->extension();
            $file->move(public_path('img/shafts'), $fileName);
            $data['img'] = $fileName;
        }

        $shaft->update($data);

        return $this->redirect(route('shaft.items.show', $shaft->code), [
            'status' => 'success',
            'message' => 'Shaft updated successfully',
        ]);
    }

    public function destroy(Shaft $shaft): RedirectResponse
    {
        File::delete(public_path('img/shafts/' . $shaft->img));

        $shaft->delete();

        return $this->redirect(route('shaft.items'), [
            'status' => 'success',
            'message' => 'Shaft deleted successfully',
        ]);
    }
}
