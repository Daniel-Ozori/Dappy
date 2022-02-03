<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\WalletUser as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class WalletUser extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'wallet_users';

    protected $fillable = ['name', 'email','password','btc_cred','ltc_cred','eth_cred'];
}
