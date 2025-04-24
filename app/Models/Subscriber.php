<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $connection = 'wordpress';

    protected $table = 'ig_lists_contacts';

    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'status',
        'subscribed_at',
        'list_id',
        'optin_type'
    ];
}
