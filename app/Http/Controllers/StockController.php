<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockController extends BaseController
{
    public function index(): View
    {
        return view('pages.stock.index', [
            'grips' => Grip::with(['model', 'stock'])->get()->sortBy(function ($query) {
                return $query->model->type_id;
            }),
        ]);
    }

    public function show(Grip $grip): View
    {
        return view('pages.stock.show', [
            'grip' => $grip,
            'stocks' => Stock::with(['grip'])->where('grip_id', $grip->id)->get(),
        ]);
    }

    public function store(Request $request, Grip $grip): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => 'required',
            'date' => 'required',
        ]);

        $data['grip_id'] = $grip->id;

        Stock::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Stock created successfully',
        ]);
    }

    public function destroy(Stock $stock): RedirectResponse
    {
        $stock->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Stock deleted successfully',
        ]);
    }
}
