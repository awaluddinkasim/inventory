<?php

namespace App\Livewire;

use App\Models\ShaftSale;
use Livewire\Attributes\On;
use Livewire\Component;

class ShaftSaleExport extends Component
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
        return view('livewire.shaft-sale-export', [
            'salesCount' => ShaftSale::whereMonth('date', $this->month)->whereYear('date', $this->year)->count(),
        ]);
    }
}
