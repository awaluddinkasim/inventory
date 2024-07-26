<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BarcodeController extends Controller
{
    public function index(): View
    {
        return view('pages.barcode.index');
    }
}
