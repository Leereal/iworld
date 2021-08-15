<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate the table.
        DB::table('plans')->truncate();
        Plan::create(['name'=>'GET 23','interest'=>'23','period'=>'7']);
        // Plan::create(['name'=>'10 Trading Days','interest'=>'60','period'=>'14']);
        // Plan::create(['name'=>'20 Trading Days','interest'=>'120','period'=>'30']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
