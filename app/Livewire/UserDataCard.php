<?php

namespace App\Livewire;

use Livewire\Component;

class UserDataCard extends Component
{
    public function render()
    {
        return view('livewire.user-data-card');
    }

    public function getListeners()
    {
        return [
            "echo-private:user-" . auth()->id() . "-payment-received,PaymentReceived" => 'updateUi',
        ];
    }

    public function updateUi()
    {
        $this->callMethod('$refresh');
    }
}
