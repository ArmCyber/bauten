<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush the application logs';

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
        $dir = storage_path('logs/');
        $files = scandir($dir);
        $ignore = ['.','..','.gitignore'];
        foreach($files as $file) {
            if (!in_array($file, $ignore)) unlink($dir.$file);
        }
        $this->info('Application logs cleared!');
        return ;
    }
}
