<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Grip;
use App\Models\User;
use App\Models\Stock;
use App\Models\GripType;
use App\Models\GripModel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();
        $stockChanges = Stock::select(
            DB::raw('strftime("%m-%Y", date) as month'), // SQLite
            // DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), // MySQL
            DB::raw('SUM(quantity) as total_quantity')
        )
            ->where('date', '>=', $sixMonthsAgo)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $stockChanges->pluck('month');
        $data = $stockChanges->pluck('total_quantity');

        $cumulativeStock = [];
        $total = 0;
        foreach ($data as $quantity) {
            $total += $quantity;
            $cumulativeStock[] = $total;
        }

        $topGripModels = GripModel::select('grip_models.*', DB::raw('SUM(stocks.quantity) as total_stock'))
            ->leftJoin('grips', 'grip_models.id', '=', 'grips.model_id')
            ->leftJoin('stocks', 'grips.id', '=', 'stocks.grip_id')
            ->groupBy('grip_models.id')
            ->orderBy('total_stock', 'desc')
            ->take(5)
            ->get();

        $totalGripTypes = GripType::count();
        $totalGripModels = GripModel::count();
        $totalGrips = Grip::count();
        $users = User::where('role', '!=', 'admin')->count();

        return view('pages.dashboard', [
            'users' => $users,
            'totalGripTypes' => $totalGripTypes,
            'totalGripModels' => $totalGripModels,
            'totalGrips' => $totalGrips,
            'cumulativeStock' => [
                'labels' => ['', ...$labels],
                'data' => [$cumulativeStock[0], ...$cumulativeStock],
            ],
            'topGripModels' => $topGripModels,
        ]);
    }
}
