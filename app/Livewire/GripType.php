<?php

namespace App\Livewire;

use App\Models\GripType as Model;
use Livewire\Component;

class GripType extends Component
{
    public $currentEdit;

    public function edit($id)
    {
        $type = Model::find($id);
        $this->currentEdit = $type;

        $this->dispatch('open-modal');
    }

    public function render()
    {
        return view('livewire.grip-type', [
            'types' => Model::all(),
        ]);
    }
}
