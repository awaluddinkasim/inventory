<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockController extends BaseController
{
    public function index(): View
    {
        return view('pages.stock.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'grip_id' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ]);

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
