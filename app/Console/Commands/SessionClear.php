<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SessionClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush the sessions';

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
        $dir = storage_path('framework/sessions/');
        $files = scandir($dir);
        $ignore = ['.','..','.gitignore'];
        foreach($files as $file) {
            if (!in_array($file, $ignore)) unlink($dir.$file);
        }
        $this->info('Sessions cleared!');
        return ;
    }
}
