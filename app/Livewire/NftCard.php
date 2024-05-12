<?php

namespace App\Livewire;

use App\Actions\ProcessNftPurchase;
use App\Models\Nft;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NftCard extends Component
{
    public Nft $nft;

    public function render()
    {
        return view('livewire.nft-card');
    }

    public function getListeners()
    {
        return [
            "echo:nft-{$this->nft->id}-purchase,NftPurchase" => 'updateUi',
        ];
    }

    public function updateUi()
    {
        $this->nft->refresh();
    }
}
