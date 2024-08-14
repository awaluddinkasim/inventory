<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\GripPurchase;
use App\Models\GripSale;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GripSaleController extends BaseController
{
    public function index(): View
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $sales = GripSale::with(['grip'])->orderBy('date')->get();

        $years = [];
        foreach ($sales as $sale) {
            $year = Carbon::parse($sale->date)->year;
            if (! in_array($year, $years)) {
                $years[] = $year;
            }
        }

        return view('pages.grip-sale.index', [
            'month' => $month,
            'year' => $year,
            'years' => $years,
            'grips' => Grip::with(['model', 'sales'])->get()->sortBy(function ($query) {
                return $query->model->type_id;
            }),
        ]);
    }

    public function show(): View
    {
        if (! request()->has('date')) {
            return back();
        }

        $date = request()->get('date');

        $sales = GripSale::with(['grip'])->where('date', $date)->get();

        return view('pages.grip-sale.show', [
            'sales' => $sales,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'grip_id' => 'required',
            'retail' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ]);

        GripSale::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip purchase created successfully',
        ]);
    }

    public function destroy(GripSale $sale): RedirectResponse
    {
        $sale->delete();

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip purchase deleted successfully',
        ]);
    }
}
