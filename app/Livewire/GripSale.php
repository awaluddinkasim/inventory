<?php

namespace App\Livewire;

use App\Models\GripSale as Model;
use Livewire\Attributes\On;
use Livewire\Component;

class GripSale extends Component
{
    public $month;
    public $year;

    #[On('filter')]
    public function filter($month, $year)
    {
        $this->month = $month;
        $this->year = $year;

        if ($month == 0) {
            $amount = Model::whereYear('date', $year)->get()->sum('amount');
        } else {
            $amount = Model::whereYear('date', $year)->whereMonth('date', $month)->get()->sum('amount');
        }

        $this->dispatch('amount', $amount);
    }

    public function render()
    {
        if ($this->month == 0) {
            $sales = Model::with(['grip'])->whereYear('date', $this->year)->orderBy('date')->paginate(10);
        } else {
            $sales = Model::with(['grip'])->whereYear('date', $this->year)->whereMonth('date', $this->month)
                ->orderBy('date')->paginate(10);
        }

        return view('livewire.grip-sale', [
            'sales' => $sales,
        ]);
    }
}
