<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $connection = 'wordpress';

    protected $table = 'ig_contacts';

    public $timestamps = true;

    protected $fillable = [
        'email'
    ];
}


