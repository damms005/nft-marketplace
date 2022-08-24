<?php

namespace App\Http\Livewire;

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

    public function buy(Nft $nft)
    {
        if (Auth::user()->account_balance < $nft->price) {
            notify()->error("Insufficient account balance. The NFT costs \${$nft->price} but your account balance is \$" . Auth::user()->account_balance . '. Perhaps it may help if you get someone to buy some of your NFTs?');
            return redirect()->to(route('homepage'));
        }

        ProcessNftPurchase::execute(Auth::user(), $this->nft);

        // redirect to payment page
        // make payment

        // ProcessNftPurchase::execute(Auth::user(), $nft);
    }
}
