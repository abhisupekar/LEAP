<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	['name' => 'Individual Contributor'],
        	['name' => 'Senior Individual Contributor'],
        	['name' => 'Team Lead'],
			['name' => 'Practise Lead'],
			['name' => 'Admin'],
        ]);
    }
}
