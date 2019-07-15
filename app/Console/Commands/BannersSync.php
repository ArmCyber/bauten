<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\BannersController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BannersSync extends Command
{
    private $path = 'admin.pages.banners';

    private $exampleFile = 'app/Services/Banners/src/example.blade.php';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'banners:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates missing view of banner page.';

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
        $dir = base_path('resources/views/'.str_replace('.', '/', $this->path).'/');
        $settings = (new BannersController)->getSettings();
        $keys = array_keys($settings);
        $exampleFile = base_path($this->exampleFile);
        if (!file_exists($exampleFile)) {
            $this->error('File "'. $this->exampleFile . '" does not exists.');
            return false;
        }
        if (!is_readable($exampleFile)) {
            $this->error('File "'. $this->exampleFile . '" is not readable.');
            return false;
        }
        if (!is_writable($dir)) {
            $this->error('Directory "'.$this->path.'" is not writable.');
            return false;
        }
        $created_files = false;
        foreach($keys as $key) {
            $filename = $key.'.blade.php';
            $file_path = $dir.$filename;
            if (!file_exists($file_path)) {
                $this->info('Created file "'.$filename.'".');
                File::copy($exampleFile, $file_path);
                $created_files = true;
            }
        }
        if (!$created_files) $this->info('Nothing to create.');
    }
}
