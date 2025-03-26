<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'productId', 'name', 'price', 'thumbnailUrl', 'width', 'height',
    ];
}
