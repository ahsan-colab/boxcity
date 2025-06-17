<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'categoryId', 'categoryName', 'parentId'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parentId', 'categoryId');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parentId', 'categoryId');
    }

    public function childrenRecursive()
    {
        return $this->children()
            ->with(['childrenRecursive', 'products'])
            ->withCount('products');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'categoryId', 'categoryId');
    }


    protected function getTotalProductCountAttribute()
    {
        $count = $this->products_count ?? $this->products()->count();

        foreach ($this->childrenRecursive as $child) {
            $count += $child->total_product_count;  // recursion here!
        }

        return $count;
    }

    public function assignTotalProductCount($category)
    {
        $category->total_product_count = $category->getTotalProductCountAttribute();

        foreach ($category->childrenRecursive as $child) {
            $this->assignTotalProductCount($child);
        }
    }

}
