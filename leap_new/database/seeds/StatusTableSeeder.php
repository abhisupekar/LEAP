<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
        	['name' => 'Submission pending by Appraisee'],
        	['name' => 'L1 Approval Pending'],
        	['name' => 'HR Approval Pending'],
        	['name' => 'Approved by HR'],
            ['name' => 'Rejected by Reporting Manager'],
            ['name' => 'Modified and Approved by HR'],
        ]);
    }
}
