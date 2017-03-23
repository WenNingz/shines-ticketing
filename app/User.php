<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'verified', 'email_token'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

}
