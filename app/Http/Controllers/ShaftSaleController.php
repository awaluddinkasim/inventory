<?php

namespace App\Http\Controllers;

use App\Models\Shaft;
use App\Models\ShaftSale;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ShaftSaleController extends BaseController
{
    public function index(): View
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $sales = ShaftSale::with(['shaft'])->orderBy('date')->get();

        $months = [0 => 'All'];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = Carbon::createFromDate($year, $i, 1)->isoFormat('MMMM');
        }

        $years = [];
        foreach ($sales as $sale) {
            $year = Carbon::parse($sale->date)->year;
            if (! in_array($year, $years)) {
                $years[] = $year;
            }
        }

        return view('pages.shaft-sale.index', [
            'activeMonth' => $month,
            'activeYear' => $year,
            'months' => $months,
            'year' => $year,
            'years' => $years,
            'salesCount' => ShaftSale::whereMonth('date', $month)->whereYear('date', $year)->count(),
            'shafts' => Shaft::with(['type', 'sales'])->orderBy('type_id')->get(),
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
            'shafts' => Shaft::with(['type', 'sales'])->orderBy('type_id')->get(),
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

        $data['retail'] = convertToNumber($data['retail']);

        ShaftSale::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft sale created successfully',
        ]);
    }

    public function destroy(ShaftSale $sale): RedirectResponse
    {
        $date = Carbon::parse($sale->date)->format('Y-m-d');

        $sale->delete();

        $count = ShaftSale::where('date', $date)->count();

        if ($count == 0) {
            return $this->redirect(route('sale.shaft'), [
                'status' => 'success',
                'message' => 'Shaft sale deleted successfully',
            ]);
        }

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Shaft sale deleted successfully',
        ]);
    }

    public function exportPdf(Request $request): Response
    {
        if (! $request->has('month') && ! $request->has('year')) {
            abort(404);
        }

        $sales = ShaftSale::with(['shaft'])
            ->whereMonth('date', $request->get('month'))->whereYear('date', $request->get('year'))
            ->orderBy('date')->get();

        $pdf = Pdf::loadView('pdf.shaft-sales', [
            'sales' => $sales
        ]);

        return $pdf->stream('shaft-sales ' . Carbon::parse($sales[0]->date)->isoFormat('MM-YY') . '.pdf');
    }
}
