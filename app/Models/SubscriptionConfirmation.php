<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionConfirmation extends Model
{
    protected $fillable = [
        'email',
        'token'
    ];
}

