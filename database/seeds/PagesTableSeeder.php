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
            [
                'id'=>1,
                'url'=>'home',
                'title'=>'Главная',
                'static'=>'home',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>2,
                'url'=>'catalogue',
                'title'=>'Каталогы',
                'static'=>'catalogs',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>3,
                'url'=>'marks',
                'title'=>'Марки',
                'static'=>'marks',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>4,
                'url'=>'brands',
                'title'=>'Бренды',
                'static'=>'brands',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>5,
                'url'=>'about',
                'title'=>'О компании',
                'static'=>'about',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],[
                'id'=>6,
                'url'=>'terms',
                'title'=>'Условия',
                'static'=>'terms',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>7,
                'url'=>'contacts',
                'title'=>'Контакты',
                'static'=>'contacts',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
        ]);
    }
}
