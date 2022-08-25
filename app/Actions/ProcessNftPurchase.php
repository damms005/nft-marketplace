<?php

namespace App\Actions;

use App\Models\Nft;
use App\Models\User;
use App\Events\NftPurchase;
use App\Events\PaymentReceived;
use Illuminate\Support\Facades\DB;

class ProcessNftPurchase
{
    public static function execute(User $buyer, Nft $nft)
    {
        /** @var User */
        $owner = $nft->current_owner;
        DB::table('users')->where('id', $owner->id)->increment('account_balance', $nft->price);

        $buyer->nftPurchases()->create(['nft_id' => $nft->id]);

        DB::table('users')->where('id', $buyer->id)->decrement('account_balance', $nft->price);

        broadcast(new NftPurchase($nft));
        broadcast(new PaymentReceived($owner));
    }
}
