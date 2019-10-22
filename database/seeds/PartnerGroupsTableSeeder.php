<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('partner_groups')->insert([
            'id'=>1,
            'title'=>'Новый',
            'sale'=>0,
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);
    }
}
