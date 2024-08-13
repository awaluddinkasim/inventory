<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\GripPurchase;
use App\Models\GripSale;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GripSaleController extends BaseController
{
    public function index(): View
    {
        return view('pages.grip-sale.index', [
            'grips' => Grip::with(['model', 'sales'])->get()->sortBy(function ($query) {
                return $query->model->type_id;
            }),
        ]);
    }

    public function show(Grip $grip): View
    {
        return view('pages.grip-sale.show', [
            'grip' => $grip,
            'sales' => GripSale::with(['grip'])->where('grip_id', $grip->id)->orderBy('date', 'desc')->get(),
        ]);
    }

    public function store(Request $request, Grip $grip): RedirectResponse
    {
        $data = $request->validate([
            'wholesale' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ]);

        $data['grip_id'] = $grip->id;

        GripPurchase::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip purchase created successfully',
        ]);
    }

    public function destroy(GripPurchase $purchase): RedirectResponse
    {
        $purchase->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip purchase deleted successfully',
        ]);
    }
}
