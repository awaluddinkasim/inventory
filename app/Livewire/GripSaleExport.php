<?php

namespace App\Livewire;

use App\Models\GripSale;
use Livewire\Attributes\On;
use Livewire\Component;

class GripSaleExport extends Component
{
    public $month;
    public $year;

    #[On('filter')]
    public function amount($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function render()
    {
        return view('livewire.grip-sale-export', [
            'salesCount' => GripSale::whereMonth('date', $this->month)->whereYear('date', $this->year)->count(),
        ]);
    }
}
