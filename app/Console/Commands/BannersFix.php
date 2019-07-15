<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\BannersController;
use Illuminate\Console\Command;

class BannersFix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'banners:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes Unused Banners From Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new BannersController)->fixBanners();
        $this->info('Unused banners removed successfully.');
    }
}
