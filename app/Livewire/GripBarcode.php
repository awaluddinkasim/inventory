<?php

namespace App\Livewire;

use App\Models\Grip;
use App\Models\GripModel;
use Livewire\Component;

class GripBarcode extends Component
{
    public $grip;

    public $selectedModel;
    public $selectedSize;
    public $selectedColor;

    public function generate()
    {
        $this->grip = Grip::where('model_id', $this->selectedModel)
            ->where('size', $this->selectedSize)
            ->where('color', $this->selectedColor)
            ->first();
    }

    public function render()
    {
        return view('livewire.grip-barcode', [
            'models' => GripModel::has('grips')->get(),
            'sizes' => Grip::where('model_id', $this->selectedModel)->groupBy('size')->pluck('size'),
            'colors' => Grip::where('model_id', $this->selectedModel)->where('size', $this->selectedSize)->groupBy('color')->pluck('color'),
        ]);
    }
}
