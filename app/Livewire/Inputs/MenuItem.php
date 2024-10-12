<?php

namespace App\Livewire\Inputs;

use Livewire\Component;
use App\Models\MenuItem as Pizza;
use App\Models\Base;

class MenuItem extends Component
{

    public $selectedValues = [];
    public $quantities = [];
    public $selectedBases = [];
    public $data = [];
    public $menuItems, $bases;
    
    public function mount() {
        $this->selectedValues[] = '';
        $this->menuItems = Pizza::all();
        $this->bases = base::all();
    }
    
    public function render()
    {
        return view('livewire.inputs.menu-item');
    }

    public function updatedSelectedValues($value, $index) {
        
        foreach ($this->selectedValues as $selectedValue) {
            if ($selectedValue) {
                $pizza = Pizza::find($selectedValue);
                $base = Base::first();
                if ($pizza) {
                    $this->data[$index]['name'] = $pizza->name;
                    $this->data[$index]['description'] = $pizza->description;
                    $this->data[$index]['base'] = $base->name;
                    $this->data[$index]['quantity'] = 1;
                }
            }
        }
        
        $this->dispatch('valueSelected', $this->data);
    }

    public function updatedQuantities($value, $index) {

        if(!count($this->data)) return;
        
        $this->data[$index]['quantity'] = $value;
        $this->dispatch('valueSelected', $this->data);
    }

    public function updatedSelectedBases($value, $index) {

        if(!count($this->data)) return;
        
        $base = Base::find($value);
        $this->data[$index]['base'] = $base->name;
        $this->dispatch('valueSelected', $this->data);
    }
    
    public function addMenuItem() {
        $this->selectedValues[] = ''; // Add a new empty value
    }

    public function removeMenuItem($index) {
        unset($this->selectedValues[$index]); // Remove the selected value by index
        unset($this->data[$index]); // Remove the selected value by index
        $this->selectedValues = array_values($this->selectedValues); // Reindex array

        $this->dispatch('valueSelected', $this->data);
    }



}
