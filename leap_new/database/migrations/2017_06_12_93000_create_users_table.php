<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('manager_id');
            $table->string('joining_date');
            $table->string('employee_code');
            $table->string('designation');
            $table->integer('department_id')->unsigned();
			$table->integer('role_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
			$table->foreign('role_id')->references('id')->on('roles');
            $table->integer('status')->default(1);
            $table->rememberToken();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
