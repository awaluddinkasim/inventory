<?php

namespace App\Livewire;

use App\Models\GripModel as Model;
use App\Models\GripType;
use Livewire\Component;

class GripModel extends Component
{
    public $types;

    public $currentEdit;

    public function edit($id)
    {
        $type = Model::find($id);
        $this->currentEdit = $type;

        $this->dispatch('open-modal');
    }

    public function render()
    {
        return view('livewire.grip-model', [
            'models' => Model::all(),
        ]);
    }
}
