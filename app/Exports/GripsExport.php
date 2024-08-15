<?php

namespace App\Exports;

use App\Models\Grip;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GripsExport implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths
{
    public function view(): View
    {
        return view('excel.grips', [
            'grips' => Grip::with(['model'])->get()->sortBy([
                fn($grip) => $grip->model->type_id,
                fn($grip) => $grip->size,
                fn($grip) => $grip->color
            ]),
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            'B' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}
