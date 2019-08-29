<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExtraLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extra:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create exports link in public/d';

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
        $file = public_path('e');
        if (file_exists($file)) {
            $this->error('public/e already exists.');
            return ;
        }
        $this->laravel->make('files')->link(
            base_path('.extra/ui/exports'), $file
        );
        $this->info('Link created.');
    }
}
