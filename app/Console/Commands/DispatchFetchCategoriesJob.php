<?php

namespace App\Console\Commands;

use App\Jobs\FetchCategoriesFromApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DispatchFetchCategoriesJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch the FetchCategoriesFromApi job to fetch and store categories from the Ecwid API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('FetchCategories executed at ' . now());

        FetchCategoriesFromApi::dispatchSync();

        Log::info('Job FetchCategories dispatched successfully at ' . now());
    }
}
