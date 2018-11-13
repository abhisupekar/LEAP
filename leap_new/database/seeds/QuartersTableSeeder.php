<?php

use Illuminate\Database\Seeder;

class QuartersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quarters')->insert([
        	['name' => 'Q4', 'start_date' => '0201', 'end_date' => '0430'],
        	['name' => 'Q1', 'start_date' => '0501', 'end_date' => '0731'],
        	['name' => 'Q2', 'start_date' => '0801', 'end_date' => '1031'],
        	['name' => 'Q3', 'start_date' => '1101', 'end_date' => '1331'],
        ]);
    }
}
