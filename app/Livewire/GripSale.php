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