<?php

namespace App\Http\Controllers;

use App\Models\GripModel;
use App\Models\GripPurchase;
use App\Models\GripSale;
use App\Models\Shaft;
use App\Models\ShaftPurchase;
use App\Models\ShaftSale;
use Carbon\Carbon;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $currentMonth = Carbon::now()->startOfYear();
        $endOfMonth = Carbon::now()->endOfYear();

        $gripSales = [];
        $shaftSales = [];

        $gripPurchases = [];
        $shaftPurchases = [];

        while ($currentMonth <= $endOfMonth) {
            $gripSales[] = GripSale::whereYear('date', $currentMonth->year)
                ->whereMonth('date', $currentMonth->month)
                ->get()->sum('amount');

            $shaftSales[] = ShaftSale::whereYear('date', $currentMonth->year)
                ->whereMonth('date', $currentMonth->month)
                ->get()->sum('amount');

            $gripPurchases[] = GripPurchase::whereYear('date', $currentMonth->year)
                ->whereMonth('date', $currentMonth->month)
                ->get()->sum('amount');

            $shaftPurchases[] = ShaftPurchase::whereYear('date', $currentMonth->year)
                ->whereMonth('date', $currentMonth->month)
                ->get()->sum('amount');

            $currentMonth = $currentMonth->addMonth();
        }

        $cumulativeGripSales = [];
        $cumulativeShaftSales = [];
        $currentMonth = Carbon::now()->startOfYear();

        $lastCumulativeGripSales = 0;
        $lastCumulativeShaftSales = 0;
        while ($currentMonth <= Carbon::now()) {
            $index = $currentMonth->isoFormat('MMM');
            $cumulativeGripSales[$index] = 0;
            $cumulativeShaftSales[$index] = 0;

            $gs = GripSale::whereYear('date', $currentMonth->year)
                ->whereMonth('date', $currentMonth->month)
                ->get()->sum('amount');

            $ss = ShaftSale::whereYear('date', $currentMonth->year)
                ->whereMonth('date', $currentMonth->month)
                ->get()->sum('amount');

            $cumulativeGripSales[$index] += $gs + $lastCumulativeGripSales;
            $cumulativeShaftSales[$index] += $ss + $lastCumulativeShaftSales;

            $lastCumulativeGripSales += $gs;
            $lastCumulativeShaftSales += $ss;

            $currentMonth = $currentMonth->addMonth();
        }

        $gripStocks = [];
        $shaftStocks = [];

        GripModel::all()->take(7)->each(function ($model) use (&$gripStocks) {
            $gripStocks[$model->name] = $model->grips->sum('stock');
        });
        Shaft::all()->take(7)->each(function ($shaft) use (&$shaftStocks) {
            $shaftStocks[$shaft->shaft] = $shaft->stock;
        });

        asort($gripStocks);
        asort($shaftStocks);

        return view('pages.reports', [
            'gripSales' => $gripSales,
            'shaftSales' => $shaftSales,
            'gripPurchases' => $gripPurchases,
            'shaftPurchases' => $shaftPurchases,
            'cumulativeGripSales' => $cumulativeGripSales,
            'cumulativeShaftSales' => $cumulativeShaftSales,
            'gripStocks' => $gripStocks,
            'shaftStocks' => $shaftStocks,
        ]);
    }
}
