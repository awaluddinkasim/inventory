<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShaftSale as Model;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class ShaftSale extends Component
{
    use WithPagination, WithoutUrlPagination;

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
            $sales = Model::with(['shaft'])->whereYear('date', $this->year)->orderBy('date')->paginate(10);
        } else {
            $sales = Model::with(['shaft'])->whereYear('date', $this->year)->whereMonth('date', $this->month)
                ->orderBy('date')->paginate(10);
        }

        return view('livewire.shaft-sale', [
            'sales' => $sales,
        ]);

    }
}
