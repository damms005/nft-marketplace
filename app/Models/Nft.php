<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nft extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    public function latestPurchase()
    {
        return $this->hasOne(NftPurchase::class)->latestOfMany();
    }

    public function getCurrentOwnerAttribute(): User
    {
        /** @var NftPurchase|null */
        $lastPurchase = $this->latestPurchase()->first();

        if ($lastPurchase) {
            return $lastPurchase->user;
        }

        return $this->originalOwner;
    }

    public function paymentMetadata(): array
    {
        return collect($this->toArray())
            ->put('completion_url', route('homepage'))
            ->toArray();
    }
}
