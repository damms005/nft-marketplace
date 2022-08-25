<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function __invoke()
    {
        return view('homepage', [
            'nfts' => Nft::with('originalOwner')
                ->get()
                ->sortBy(fn (Nft $nft) => $nft->current_owner->name)
        ]);
    }
}
