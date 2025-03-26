<?php

namespace App\Console\Commands;

use App\Jobs\FetchProductsFromApi;
use Illuminate\Console\Command;

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
        $this->info('Dispatching the FetchProductsFromApi job...');

        // Dispatch the job
        dispatch(new FetchProductsFromApi());

        $this->info('Job dispatched successfully.');
    }
}
