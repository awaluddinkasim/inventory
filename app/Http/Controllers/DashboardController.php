<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use App\Models\User;
use App\Models\Shaft;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('pages.dashboard', [
            'users' => User::count(),
            'grips' => Grip::count(),
            'shafts' => Shaft::count(),
        ]);
    }
}
