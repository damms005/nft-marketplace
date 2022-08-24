<?php

namespace App\Actions;

use App\Models\Nft;
use App\Models\User;
use App\Events\NftPurchase;
use App\Events\PaymentReceived;

class ProcessNftPurchase
{
    public static function execute(User $buyer, Nft $nft)
    {
        broadcast(new NftPurchase($nft)); // nft card @UI updates with details of new user and new price. notification popup also clicks in
        // broadcast(new PaymentReceived($nft)); // user bought from will see notification of the new sale, and amount increase
    }
}
