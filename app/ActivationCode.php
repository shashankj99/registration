<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{
    protected $fillable = ['code'];

    /**
     * return a specific column instead of id in route parameter
     */
    public function getRouteKeyName() {
        return 'code';
    }

    /**
     * Get the user that has this activation code
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
