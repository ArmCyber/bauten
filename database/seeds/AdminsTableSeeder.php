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
            [
                'id'=>1,
                'name'=>'Developer',
                'email'=>'dev@dev.loc',
                'password'=>Hash::make('12345678'),
                'role'=>4,
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>2,
                'name'=>'Administrator',
                'email'=>'admin@dev.loc',
                'password'=>Hash::make('12345678'),
                'role'=>3,
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>3,
                'name'=>'Manager',
                'email'=>'manager@dev.loc',
                'password'=>Hash::make('12345678'),
                'role'=>2,
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'id'=>4,
                'name'=>'Operator',
                'email'=>'operator@dev.loc',
                'password'=>Hash::make('12345678'),
                'role'=>1,
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
        ]);
    }
}
