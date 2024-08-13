<?php

namespace App\Http\Controllers;

use App\Models\Shaft;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ShaftPurchase;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;

class ShaftPurchaseController extends BaseController
{
    public function index(): View
    {
        return view('pages.shaft-purchase.index', [
            'shafts' => Shaft::with(['type', 'purchases'])->orderBy('type_id')->get(),
        ]);
    }

    public function show(Shaft $shaft): View
    {
        return view('pages.shaft-purchase.show', [
            'shaft' => $shaft,
            'purchases' => ShaftPurchase::with(['shaft'])->where('shaft_id', $shaft->id)->orderBy('date', 'desc')->get(),
        ]);
    }

    public function store(Request $request, Shaft $shaft): RedirectResponse
    {
        $data = $request->validate([
            'wholesale' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ]);

        $data['shaft_id'] = $shaft->id;

        ShaftPurchase::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft purchase created successfully',
        ]);
    }

    public function destroy(ShaftPurchase $purchase): RedirectResponse
    {
        $purchase->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft purchase deleted successfully',
        ]);
    }
}
