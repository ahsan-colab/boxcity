<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display the product listing page.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::with('childrenRecursive')->whereNull('parent_id')->get();
        dd($categories);
    }
}
