<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Component;

class AddNewFeature extends Component
{
    public $option;
    public $newFeature = [
        'value' => '',
        'description' => '',
    ];



    public function addFeature()
    {
        $this->validate(
            [
                'newFeature.value' => 'required',
                'newFeature.description' => 'required|max:255',
            ]
        );
        $this->option->features()->create($this->newFeature);
        // Emitir un evento para actualizar la lista de options
        $this->dispatch('featureAdded');
        $this->reset('newFeature');
        // $this->dispatch('swal', [
        //     'icon' => 'success',
        //     'title' => '!Bien hecho!',
        //     'text' => 'El valor ha sido agregado exitosamente',
        //     'type' => 'success',
        // ]);
    }

    public function render()
    {
        return view('livewire.admin.options.add-new-feature');
    }
}
