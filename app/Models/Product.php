<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'productId', 'name', 'price', 'sku', 'categoryId', 'thumbnailUrl', 'length', 'width', 'height', 'description',
    ];

    /**
     * @param $query
     * @param $min
     * @param $max
     * @return mixed
     */
    public function scopeLengthBetween($query, $min, $max)
    {
        return $query->whereRaw('CAST(length AS UNSIGNED) BETWEEN ? AND ?', [$min, $max]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }

}
