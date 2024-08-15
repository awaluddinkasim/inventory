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
        return view('excel.shafts', [
            'shafts' => Grip::with(['model'])->get()->sortBy(function ($query) {
                return $query->model->type_id;
            }),
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
