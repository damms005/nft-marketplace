<?php

namespace Database\Seeders;

use App\Models\Nft;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection */
        $imagesUrls = Cache::remember('images-2', now()->addMinute(50), function () {
            $response = Http::withHeaders(['Authorization' => 'Client-ID d4Ms9DR1flEa3I0vU4KeBni6gxbu6kHy1KhZnohXzjA'])
                ->asJson()
                ->get('https://api.unsplash.com/photos/random?count=30')
                ->json();

            return collect($response);
        });

        // Create users and give them NFTs for free
        User::factory()
            ->count(10)
            ->create()
            ->each(
                fn (User $user) => Nft::factory()
                    ->count(rand(2, 6))
                    ->for($user, 'originalOwner')
                    ->create([
                        'image_url' => Arr::get($imagesUrls->random(), 'urls.small')
                    ])
            );
    }
}
