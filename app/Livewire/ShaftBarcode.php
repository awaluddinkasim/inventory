<?php

namespace App\Livewire;

use App\Models\Shaft;
use App\Models\ShaftType;
use Livewire\Component;

class ShaftBarcode extends Component
{
    public $shaft;

    public $selectedType;
    public $selectedShaft;

    public function generate()
    {
        $this->shaft = Shaft::where('id', $this->selectedShaft)
            ->where('type_id', $this->selectedType)
            ->first();
    }

    public function render()
    {
        return view('livewire.shaft-barcode', [
            'types' => ShaftType::has('shafts')->get(),
            'shafts' => Shaft::where('type_id', $this->selectedType)->get(),
        ]);
    }
}
