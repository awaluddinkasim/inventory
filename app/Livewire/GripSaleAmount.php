<?php

namespace App\Livewire;

use App\Models\GripSale;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class GripSaleAmount extends Component
{
    public $amount;

    #[On('filter')]
    public function amount($month, $year)
    {
        if ($month == 0) {
            $amount = GripSale::whereYear('date', $year)->get()->sum('amount');
        } else {
            $amount = GripSale::whereYear('date', $year)->whereMonth('date', $month)->get()->sum('amount');
        }

        $this->amount = $amount;
    }

    public function boot()
    {
        $sales = GripSale::with(['grip'])->whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)
            ->orderBy('date')->get();

        $this->amount = $sales->sum('amount');
    }

    public function render()
    {
        return view('livewire.grip-sale-amount');
    }
}
