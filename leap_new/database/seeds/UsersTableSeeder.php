<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        DB::table('users')->insert([
        [    
            'first_name' => 'Krishna',
            'last_name' => 'Soni',
            'email' => 'krishnaasoni@gmail.com',
            'password' => bcrypt('Parkar@123_'),
            'manager_id' => 1,
            'department_id' => 1,
			'role_id' => 3,
            'status' => 1,
            'joining_date' => '2017-02-03',
            'employee_code' => 'PCG0121',
            'designation' => 'Tech Specialist',
        ],
        [
            'first_name' => 'HR',
            'last_name' => 'LEAP',
            'email' => 'hrops@parkar.consulting',
            'password' => bcrypt('Parkar@321_'),
            'manager_id' => 2,
            'department_id' => 1,
            'role_id' => 5,
            'status' => 1,
            'joining_date' => '2017-02-03',
            'employee_code' => 'PCG0000',
            'designation' => 'HR Ops',
        ]
        ]);
    }
}
