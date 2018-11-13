<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(DepartmentsTableSeeder::class);
		$this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    	$this->call(KpisTableSeeder::class);
        $this->call(SubkpisTableSeeder::class);
        $this->call(QuartersTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(KpisubkpisdepartmentTableSeeder::class);
    }
}
