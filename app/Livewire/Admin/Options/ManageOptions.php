<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{

    public $options;
    public $newOption = [
        'name' => '',
        'type' => 1,
        'features' => [
            [
                'value' => '',
                'description' => '',
            ],
        ],
    ];
    public $openModal = false;

    public function mount()
    {
        $this->options = Option::with('features')->get();
    }


    public function addFeature()
    {
        $this->newOption['features'][] = [
            'value' => '',
            'description' => '',
        ];
    }

    public function removeFeature($index)
    {
        unset($this->newOption['features'][$index]);
        $this->newOption['features'] = array_values($this->newOption['features']);
    }

    public function addOption()
    {
        $rules = [
            'newOption.name' => 'required',
            'newOption.type' => 'required',
            'newOption.features' => 'required|array|min:1',
        ];
        foreach ($this->newOption['features'] as $index => $feature) {
            // $rules['newOption.features.' . $index . '.value'] = 'required';

            if ($this->newOption['type'] == 1) {
                $rules['newOption.features.' . $index . '.value'] = 'required';
            } else {
                $rules['newOption.features.' . $index . '.value'] = 'required|regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/';
            }
            $rules['newOption.features.' . $index . '.description'] = 'required|max:255';
        }
        $this->validate($rules);
        $option = Option::create([
            'name' => $this->newOption['name'],
            'type' => $this->newOption['type'],
        ]);

        foreach ($this->newOption['features'] as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }
        $this->options = Option::with('features')->get();
        $this->reset('openModal', 'newOption');
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '!Bien hecho!',
            'text' => 'La opción ha sido creada exitosamente',
            'type' => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
