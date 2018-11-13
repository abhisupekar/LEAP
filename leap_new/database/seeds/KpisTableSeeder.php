<?php

use Illuminate\Database\Seeder;

class KpisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kpis')->insert([
        	['name' => 'Delivery'],
        	['name' => 'Customer'],
            ['name' => 'Organization'],
            ['name' => 'Learning and Development'],
        ]);
    }
}
