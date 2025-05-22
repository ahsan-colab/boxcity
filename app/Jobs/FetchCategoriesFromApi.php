<?php

namespace App\Jobs;

use App\Services\EcwidApiClient;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use App\Models\Category;


class FetchCategoriesFromApi
{
    use Dispatchable;

    public function handle(): void
    {
        $ecwidApiClient = new EcwidApiClient();
        $limit = config('ecwid.limit');
        $offset = 0;
        $totalFetched = 0;

        try {
            $data = $ecwidApiClient->fetchCategories($limit, $offset);
            // Get the total number of products
            $total = $data['total'];
            $this->storeParentCategory();

            do {
                $data = $ecwidApiClient->fetchCategories($limit, $offset);
                $categories = $data['items'];

                $totalFetched += count($categories);

                // Store valid products
                $this->storeCategories($categories);

                $offset += $limit; // Move to the next set of products
            } while ($totalFetched < $total);
        } catch (\Exception $e) {
            Log::error('Failed to fetch categories from API', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Store or update products in the database
     *
     * @param array $categories
     * @return void
     */
    public function storeCategories(array $categories): void
    {
        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['categoryId' => $category['id']],
                [
                    'categoryName' => $category['name'] ?? '',
                    'parentId' => $category['parentId'] ?? null,
                ]
            );
        }
    }

    /**
     * Store or update parent products in the database
     *
     * @return void
     */
    public function storeParentCategory(): void
    {
        Category::updateOrCreate(
            ['categoryId' => config('ecwid.category_id')],
            [
                'categoryName' => 'Corrugated Boxes',
                'parentId' => null,
            ]
        );
    }
}

