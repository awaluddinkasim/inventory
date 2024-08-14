<?php

namespace App\Http\Controllers;

use App\Models\Shaft;
use App\Models\ShaftSale;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShaftSaleController extends BaseController
{
    public function index(): View
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $sales = ShaftSale::with(['shaft'])->orderBy('date')->get();

        $years = [];
        foreach ($sales as $sale) {
            $year = Carbon::parse($sale->date)->year;
            if (! in_array($year, $years)) {
                $years[] = $year;
            }
        }

        return view('pages.shaft-sale.index', [
            'month' => $month,
            'year' => $year,
            'years' => $years,
            'shaft' => Shaft::with(['type', 'sales'])->get()->sortBy(function ($query) {
                return $query->type_id;
            }),
        ]);
    }

    public function show(): View
    {
        if (! request()->has('date')) {
            abort(404);
        }

        $date = request()->get('date');

        $sales = ShaftSale::with(['shaft'])->where('date', $date)->get();

        return view('pages.shaft-sale.show', [
            'sales' => $sales,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'shaft_id' => 'required',
            'retail' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ]);

        ShaftSale::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft sale created successfully',
        ]);
    }

    public function destroy(ShaftSale $sale): RedirectResponse
    {
        $sale->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft sale deleted successfully',
        ]);
    }
}
