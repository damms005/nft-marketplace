<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nft extends Model
{
    use HasFactory;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originalOwner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nftPurchases(): HasMany
    {
        return $this->hasMany(NftPurchase::class);
    }

    public function getCurrentOwnerAttribute(): User
    {
        /** @var NftPurchase|null */
        $lastPurchase = $this->nftPurchases()->limit(1)->latest()->get()->last();

        if ($lastPurchase) {
            return $lastPurchase->user;
        }

        return $this->originalOwner;
    }
}
