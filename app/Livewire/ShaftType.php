<?php

namespace App\Livewire;

use App\Models\ShaftType as Model;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ShaftType extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $brands;

    public $currentEdit;

    public function edit($id)
    {
        $type = Model::find($id);
        $this->currentEdit = $type;

        $this->dispatch('open-modal');
    }
    public function render()
    {
        return view('livewire.shaft-type', [
            'types' => Model::paginate(10),
        ]);
    }
}
