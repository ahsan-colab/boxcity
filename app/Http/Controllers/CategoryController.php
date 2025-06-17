<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
        $categories = Category::with(['childrenRecursive'])
            ->withCount('products')
            ->whereNull('parentId')
            ->get();

        foreach ($categories as $category) {
            $category->assignTotalProductCount($category);
        }

        dd($categories[0]->childrenRecursive);
        return view('index', compact('categories'));

    }



    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getProductsByCategoryLevel(Request $request)
    {
        $categoryId = $request->get('categoryId');
        $category = Category::where('categoryId', $categoryId)->first();

        if (!$category) {
            return collect(); // or throw an exception
        }

        // Check if it has children (i.e. it's a 1st or 2nd level)
        if ($category->children()->exists()) {
            // It's a parent — get all descendant categoryIds
            $allCategoryIds = collect([$category->categoryId]);
            $this->collectDescendantCategoryIds($category, $allCategoryIds);

            // Get all products under this branch
            return $this->bindResponse(Product::whereIn('categoryId', $allCategoryIds)->paginate(60));
        } else {

            return $this->bindResponse(Product::where('categoryId', $category->categoryId)->paginate(60));
        }
    }

    // Recursive helper to collect all descendant categoryIds
    public function collectDescendantCategoryIds($category, &$ids)
    {
        foreach ($category->children as $child) {
            $ids->push($child->categoryId);
            $this->collectDescendantCategoryIds($child, $ids);
        }
    }

    protected function bindResponse($products){
        $productHtml = view('partials.product_list', ['products' => $products, 'scroll' => 'false'])->render();

        return response()->json([
            'product_html' => $productHtml,
            'next_page_url' => $products->nextPageUrl(),
            'has_more' => $products->hasMorePages(),
        ]);
    }


}
