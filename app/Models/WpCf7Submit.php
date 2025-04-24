<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WpCf7submit extends Model
{
    protected $connection = 'wordpress';

    protected $table = 'db7_forms';

    public $timestamps = false;

    protected $fillable = [
        'form_post_id',
        'form_value',
        'form_date',
    ];
}


