<?php

namespace App\Http\Controllers;

use App\Models\Grip;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\GripSale;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GripSaleController extends BaseController
{
    public function index(): View
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $sales = GripSale::with(['grip'])->orderBy('date')->get();

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

        return view('pages.grip-sale.index', [
            'activeMonth' => $month,
            'activeYear' => $year,
            'months' => $months,
            'years' => $years,
            'grips' => Grip::with(['model'])->get()
                ->sortBy(fn($grip) => $grip->size)
                ->sortBy(fn($grip) => $grip->model_id)
                ->sortBy(fn($grip) => $grip->model->type_id)
        ]);
    }

    public function show(): View
    {
        if (! request()->has('date')) {
            abort(404);
        }

        $date = request()->get('date');

        $sales = GripSale::with(['grip'])->where('date', $date)->get();

        return view('pages.grip-sale.show', [
            'sales' => $sales,
            'grips' => Grip::with(['model'])->get()
                ->sortBy(fn($grip) => $grip->size)
                ->sortBy(fn($grip) => $grip->model_id)
                ->sortBy(fn($grip) => $grip->model->type_id)
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

        $data['retail'] = convertToNumber($data['retail']);

        GripSale::create($data);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip sale created successfully',
        ]);
    }

    public function destroy(GripSale $sale): RedirectResponse
    {
        $date = Carbon::parse($sale->date)->format('Y-m-d');

        $sale->delete();

        $count = GripSale::where('date', $date)->count();

        if ($count == 0) {
            return $this->redirect(route('sale.grip'), [
                'status' => 'success',
                'message' => 'Grip sale deleted successfully',
            ]);
        }

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Grip sale deleted successfully',
        ]);
    }

    public function exportPdf(Request $request): Response
    {
        if (! $request->has('month') && ! $request->has('year')) {
            abort(404);
        }

        $sales = GripSale::with(['grip'])
            ->whereMonth('date', $request->get('month'))->whereYear('date', $request->get('year'))
            ->orderBy('date')->get();

        $pdf = Pdf::loadView('pdf.grip-sales', [
            'sales' => $sales
        ]);

        return $pdf->stream('grip-sales ' . Carbon::parse($sales[0]->date)->isoFormat('MM-YY') . '.pdf');
    }
}
