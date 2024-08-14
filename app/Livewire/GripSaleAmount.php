<?php

namespace App\Livewire;

use App\Models\GripSale;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class GripSaleAmount extends Component
{
    public $amount;

    #[On('amount')]
    public function amount($amount)
    {
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
