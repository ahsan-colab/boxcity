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
        return $this->children()->with('childrenRecursive')->withCount('products');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'categoryId', 'categoryId');
    }
}
