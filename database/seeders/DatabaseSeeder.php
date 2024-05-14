<?php

namespace Database\Seeders;

use App\Models\Nft;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\Sequence;

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
        $nfts = Cache::remember('sample-images', now()->addMinute(10), function () {
            $response = Http::withHeaders(['Authorization' => 'Client-ID ' . env('UNSPLASH_CLIENT_ID')])
                ->asJson()
                ->get('https://api.unsplash.com/photos/random?orientation=portrait&collections=editorial,salt-life-for-me,bright%2C-white-%2B-light&count=30')
                ->json();

            return collect($response);
        });

        // Create users and give them NFTs for free
        User::factory()
            ->count(5)
            ->create()
            ->push(User::factory()->create([
                'name' => 'Damilola Olowookere',
                'email' => 'damms005@gmail.com',
                'password' => bcrypt('damms005@gmail.com'),
            ]))
            ->each(
                fn (User $user) => Nft::factory()
                    ->count(rand(3, 6))
                    ->for($user, 'originalOwner')
                    ->sequence(
                        function (Sequence $sequence) use (&$nfts) {
                            $nft = $nfts->shift();

                            return [
                                'image_url' => Arr::get($nft, 'urls.regular'),
                            ];
                        }
                    )
                    ->create()
            );
    }
}
