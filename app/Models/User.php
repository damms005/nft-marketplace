<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Salfade\LoginTracker\Models\LoginAttempt;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Salfade\LoginTracker\Traits\HasLoginAttempts;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasLoginAttempts;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nfts(): HasMany
    {
        return $this->hasMany(Nft::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nftPurchases(): HasMany
    {
        return $this->hasMany(NftPurchase::class);
    }

    public function mostRecentLoginAttempt(): HasOne
    {
        return $this->hasOne(LoginAttempt::class)->latestOfMany();
    }

    public function canBuy(Nft $nft)
    {
        return $this->account_balance >= $nft->price
            &&
            $this->id != $nft->current_owner->id;
    }
}
