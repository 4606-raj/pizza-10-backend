<?php

namespace App\Livewire;

use Livewire\Component;

class ShowValue extends Component
{

    protected $listeners = ['valueSelected' => 'updateValue'];
    
    public function mount() {
        $this->value = 'here';
    }
    
    public function render()
    {
        return view('livewire.show-value');
    }

    public function updateValue($value) {
        $this->value = $value;
    }
}
