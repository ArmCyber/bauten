<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('pages')->insert([
            'id'=>1,
            'url'=>'home',
            'title'=>'Главная',
            'static'=>'home',
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);
    }
}
