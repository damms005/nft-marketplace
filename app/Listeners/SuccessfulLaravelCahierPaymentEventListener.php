<?php

namespace App\Listeners;

use App\Models\User;
use App\Actions\ProcessNftPurchase;
use App\Models\Nft;
use Damms005\LaravelMultipay\Events\SuccessfulLaravelMultipayPaymentEvent;

class SuccessfulLaravelCahierPaymentEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SuccessfulLaravelMultipayPaymentEvent $paymentEvent)
    {
        $buyer = $paymentEvent->payment->load('user')->user;
        $nft = Nft::findOrFail($paymentEvent->payment->metadata['id']);

        ProcessNftPurchase::execute($buyer, $nft);
    }
}
