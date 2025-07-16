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
        $min = $request->get('min');
        $max = $request->get('max');
        $category = Category::where('categoryId', $categoryId)->first();

        if (!$min && !$max && !$category) {
            return response()->json([]);
        }


        if ($min && $max && !$category){
           return $this->bindResponse(Product::lengthBetween($min, $max)->paginate(60));
        } elseif($min && $max && $category){
            $productsLength = Product::select('id')->lengthBetween($min, $max)->pluck('id');
        }


        // Check if it has children (i.e. it's a 1st or 2nd level)
        if ($category && $category->children()->exists()) {
            // It's a parent — get all descendant categoryIds
            $allCategoryIds = collect([$category->categoryId]);
            $this->collectDescendantCategoryIds($category, $allCategoryIds);

            $products = Product::whereIn('categoryId', $allCategoryIds);
            if(isset($productsLength)){
                $products->whereIn('id', $productsLength);
            }
            // Get all products under this branch
            return $this->bindResponse($products->get());
        } else {
            $products = Product::where('categoryId', $category->categoryId);
            if(isset($productsLength)){
                $products = $products->whereIn('id', $productsLength);
            }
            return $this->bindResponse($products->get());
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
            'product_html' => $productHtml
        ]);
    }


}
