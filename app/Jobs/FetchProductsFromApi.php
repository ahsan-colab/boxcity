<?php

namespace App\Jobs;


use App\Models\Product;
use App\Services\EcwidApiClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

/**
 * Class FetchProductsFromApi
 * Fetches products from the Ecwid API and stores them in the database
 *
 * @package App\Jobs
 */
class FetchProductsFromApi
{
    use Dispatchable;
    /**
     * The Ecwid API client instance
     *
     * @var EcwidApiClient
     */
    private EcwidApiClient $ecwidApiClient;

    /**
     * Execute the job to fetch and store the products
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $ecwidApiClient = new EcwidApiClient();
        $limit = config('ecwid.limit');
        $offset = 0;
        $totalFetched = 0;

        try {
            // Get the total number of products
            $data = $ecwidApiClient->fetchProducts($limit, $offset);
            $total = $data['total'];

            do {
                $data = $ecwidApiClient->fetchProducts($limit, $offset);
                $products = $data['items'];

                $filteredProducts = $this->filterValidProducts($products);
                $totalFetched += count($products);

                // Store valid products
                $this->storeProducts($filteredProducts);

                $offset += $limit; // Move to the next set of products
            } while ($totalFetched < $total);
        } catch (\Exception $e) {
            Log::error('Failed to fetch products from API', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Filter products to only include those with a positive quantity
     *
     * @param array $products
     * @return array
     */
    private function filterValidProducts(array $products): array
    {
        return array_filter($products, function ($product) {
            return isset($product['quantity']) && $product['quantity'] > 0;
        });
    }

    /**
     * Store or update products in the database
     *
     * @param array $products
     * @return void
     */
    public function storeProducts(array $products): void
    {
        foreach ($products as $product) {
            Product::updateOrCreate(
                ['productId' => $product['id']],
                [
                    'name' => $product['name'] ?? '',
                    'price' => $product['price'] ?? '',
                    'thumbnailUrl' => $product['thumbnailUrl'] ?? null,
                    'width' => $product['width'] ?? '',
                    'height' => $product['height'] ?? '',
                    'sku' => $product['sku'] ?? '',
                    'categoryId' => $product['categoryIds'][0] ?? '',
                    'description' => $product['description'] ?? '',
                ]
            );
        }
    }
}
