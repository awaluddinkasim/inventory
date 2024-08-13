<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use App\Models\GripImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class GripImageController extends BaseController
{
    public function store(Request $request, Grip $grip): RedirectResponse
    {
        $data = $request->validate([
            'img' => 'required|image',
        ]);

        $data['grip_id'] = $grip->id;

        $file = $request->file('img');
        $filename = $grip->code . '-' . time() . '.' . $file->extension();
        $file->move(public_path('img/grips'), $filename);

        $data['filename'] = $filename;

        GripImage::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip image uploaded successfully',
        ]);
    }

    public function destroy(GripImage $image): RedirectResponse
    {
        File::delete(public_path('img/grips/' . $image->filename));

        $image->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip image deleted successfully',
        ]);
    }
}
