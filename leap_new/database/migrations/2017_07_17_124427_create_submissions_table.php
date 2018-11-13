<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('kpi_id')->unsigned();
            $table->integer('subkpi_id')->unsigned();
            $table->integer('quarter_id')->unsigned();
            $table->integer('rating')->unsigned();
            $table->text('description');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kpi_id')->references('id')->on('kpis');
            $table->foreign('subkpi_id')->references('id')->on('subkpis');
            $table->foreign('quarter_id')->references('id')->on('quarters');
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
        Schema::dropIfExists('submissions');
    }
}
