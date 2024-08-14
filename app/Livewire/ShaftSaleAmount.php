<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ShaftSale;

class ShaftSaleAmount extends Component
{
    public $amount;

    #[On('filter')]
    public function amount($month, $year)
    {
        if ($month == 0) {
            $amount = ShaftSale::whereYear('date', $year)->get()->sum('amount');
        } else {
            $amount = ShaftSale::whereYear('date', $year)->whereMonth('date', $month)->get()->sum('amount');
        }

        $this->amount = $amount;
    }

    public function boot()
    {
        $sales = ShaftSale::with(['shaft'])->whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)
            ->orderBy('date')->get();

        $this->amount = $sales->sum('amount');
    }

    public function render()
    {
        return view('livewire.grip-sale-amount');
    }
}
