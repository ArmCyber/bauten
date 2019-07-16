<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DbImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports previously exported table to database.';

    private $file;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->file = storage_path('app/db.sql');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!file_exists($this->file)) {
            $this->error('File does not exist.');
            return;
        }
        if (!$this->confirm('This will remove all your current database data.')) {
            $this->warn('Canceled.');
            return;
        }
        Schema::dropAllTables();
        DB::unprepared(file_get_contents($this->file));
        $this->info('Database imported.');
        return;
    }
}
