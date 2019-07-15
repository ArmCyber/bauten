<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SettingsGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:get {key?} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows value of "settings.json" key.';

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
        if ($this->option('all')){
            $this->showAll();
        }
        else {
            $this->showOne();
        }
    }

    private function getValueInfo($value){
        switch (gettype($value)) {
            case 'NULL': $valueInfo = 'null'; break;
            case 'integer': $valueInfo = (string) $value; break;
            case 'boolean': $valueInfo = $value?'true':'false'; break;
            default: $valueInfo = '"'.$value.'"';
        }
        return $valueInfo;
    }

    private function showOne(){
        $key = $this->argument('key');
        if (!$key) {
            $this->error('Not enough arguments (missing: \"key\").');
            return;
        }
        if (!settings()->has($key)) {
            $this->error('Attribute "'.$key.'" does not exist.');
        }
        else $this->info('["'.$key.'" => '.$this->getValueInfo(settings($key)).']');
    }

    private function showAll(){
        $params = settings()->all();
        if (count($params)==0) {
            $this->warn('[]');
            return;
        }
        $lastKey = array_keys($params)[count($params)-1];
        $this->info('[');
        foreach ($params as $key=>$value) $this->info('  "'.$key.'" => '.$this->getValueInfo($value).($key!=$lastKey?',':null));
        $this->info(']');
    }
}
