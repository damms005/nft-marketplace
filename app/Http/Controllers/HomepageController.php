<?php

namespace App\Http\Controllers;

use App\Models\Nft;

class HomepageController extends Controller
{
    public function __invoke()
    {
        return view('homepage', [
            'nfts' => Nft::with('originalOwner')
                ->orderBy('original_owner_id')
                ->get()
        ]);
    }
}
