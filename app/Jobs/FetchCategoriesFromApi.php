<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchCategoriesFromApi implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function handle(): void
    {
        $url = 'https://app.ecwid.com/api/v3/109333282/categories';
        $params = [
            'withSubcategories' => 'true',
            'hidden_categories' => 'true',
            'parentIds' => '174055330',
        ];

        try {
            $response = Http::get($url, $params);

            if ($response->successful()) {
                $categories = $response->json('items');

                foreach ($categories as $category) {
                    Category::updateOrCreate(
                        ['id' => $category['id']],
                        [
                            'category_name' => $category['name'] ?? '',
                            'parent_id' => $category['parentId'] ?? null,
                        ]
                    );
                }

                Log::info('Categories successfully fetched and stored.');
            } else {
                Log::error('Failed to fetch categories: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error while fetching categories: ' . $e->getMessage());
        }
    }
}

