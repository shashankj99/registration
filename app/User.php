<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the activation code associated with the user
     */
    public function userActivationCode() {
        return $this->hasOne(ActivationCode::class);
    }

    /**
     * check whether the user is active or not
     */
    public function userIsActive() {
        return ($this->active) ? true : false;
    }
}
