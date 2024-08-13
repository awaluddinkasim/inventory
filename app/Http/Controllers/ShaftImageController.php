<?php

namespace App\Http\Controllers;

use App\Models\Shaft;
use App\Models\ShaftImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\File;

class ShaftImageController extends BaseController
{
    public function store(Request $request, Shaft $shaft): RedirectResponse
    {
        $data = $request->validate([
            'img' => 'required|image',
        ]);

        $data['shaft_id'] = $shaft->id;

        $file = $request->file('img');
        $filename = $shaft->code . '-' . time() . '.' . $file->extension();
        $file->move(public_path('img/shafts'), $filename);

        $data['filename'] = $filename;

        ShaftImage::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft image uploaded successfully',
        ]);
    }

    public function destroy(ShaftImage $image): RedirectResponse
    {
        File::delete(public_path('img/shafts/' . $image->filename));

        $image->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft image deleted successfully',
        ]);
    }
}
