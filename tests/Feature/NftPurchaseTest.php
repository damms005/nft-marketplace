<?php

namespace Tests\Feature;

use App\Models\Nft;
use Tests\TestCase;
use App\Models\User;
use App\Events\NftPurchase;
use App\Events\PaymentReceived;
use App\Actions\ProcessNftPurchase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertEquals;

class NftPurchaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_dispatched_nft_purchase_events()
    {
        Event::fake();

        $nft = Nft::factory()->for(User::factory(['account_balance' => 200]), 'originalOwner')->create(['price' => 20]);
        $dude = User::factory()->create(['account_balance' => 100]);

        assertEquals(Nft::count(), 1);
        assertEquals(User::count(), 2);

        ProcessNftPurchase::execute($dude, $nft);

        Event::assertDispatchedTimes(NftPurchase::class, 1);
        Event::assertDispatchedTimes(PaymentReceived::class, 1);
    }

    /** @test */
    public function it_switches_owner_after_nft_purchase()
    {
        $nft = Nft::factory()->for(User::factory(['name' => 'Dan', 'account_balance' => 200]), 'originalOwner')->create(['price' => 20]);
        $originalOwner = $nft->current_owner;
        $dude = User::factory()->create(['name' => 'Ali', 'account_balance' => 100]);

        ProcessNftPurchase::execute($dude, $nft);

        assertEquals($originalOwner->name, 'Dan');
        assertEquals($nft->current_owner->name, 'Ali');
    }

    /** @test */
    public function it_updates_account_balances_after_nft_purchase()
    {
        $nft = Nft::factory()->for(User::factory(['name' => 'Dan', 'account_balance' => 200]), 'originalOwner')->create(['price' => 20]);
        $originalOwner = $nft->current_owner;
        $ali = User::factory()->create(['name' => 'Ali', 'account_balance' => 100]);

        ProcessNftPurchase::execute($ali, $nft);

        assertEquals($originalOwner->refresh()->account_balance, 220);
        assertEquals($nft->current_owner->account_balance, 80);
    }
}
