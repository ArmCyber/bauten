<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('admins')->insert([
            'id'=>1,
            'name'=>'Developer',
            'email'=>'dev@dev.loc',
            'password'=>Hash::make('12345678'),
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);
    }
}
