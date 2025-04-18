<?php

namespace App\Console\Commands;

use App\Jobs\FetchProductsFromApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DispatchFetchProductsJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch the FetchProductsFromApi job to fetch and store products from the Ecwid API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('FetchProducts executed at ' . now());

        FetchProductsFromApi::dispatchSync();

        Log::info('Job dispatched successfully at ' . now());
    }
}
