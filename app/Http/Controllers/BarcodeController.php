<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BarcodeController extends BaseController
{
    public function index(): View
    {
        return view('pages.barcode.index');
    }
}
