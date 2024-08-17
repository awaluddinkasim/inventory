<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use App\Models\GripPurchase;
use App\Models\GripSale;
use App\Models\User;
use App\Models\Shaft;
use App\Models\ShaftPurchase;
use App\Models\ShaftSale;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $currentDay = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $gripSales = [];
        $shaftSales = [];

        while ($currentDay <= $endOfWeek) {
            $gripSales[] = GripSale::whereYear('date', $currentDay->year)
                ->whereMonth('date', $currentDay->month)
                ->whereDay('date', $currentDay->day)
                ->get()->sum('amount');

            $shaftSales[] = ShaftSale::whereYear('date', $currentDay->year)
                ->whereMonth('date', $currentDay->month)
                ->whereDay('date', $currentDay->day)
                ->get()->sum('amount');

            $currentDay = $currentDay->addDay();
        }

        $todaySales = 0;
        GripSale::whereDate('date', Carbon::today())->get()->each(function ($sale) use (&$todaySales) {
            $todaySales += $sale->amount;
        });
        ShaftSale::whereDate('date', Carbon::today())->get()->each(function ($sale) use (&$todaySales) {
            $todaySales += $sale->amount;
        });

        $purchases = [];
        $purchases[] = GripPurchase::all()->sum('amount');
        $purchases[] = ShaftPurchase::all()->sum('amount');

        return view('pages.dashboard', [
            'users' => User::count(),
            'grips' => Grip::all()->sum('stock'),
            'shafts' => Shaft::all()->sum('stock'),
            'todaySales' => $todaySales,
            'gripSales' => $gripSales,
            'shaftSales' => $shaftSales,
            'purchases' => $purchases
        ]);
    }
}
