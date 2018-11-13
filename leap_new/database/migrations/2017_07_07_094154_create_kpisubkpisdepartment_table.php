<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpisubkpisdepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_subkpis_department', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kpi_id')->unsigned();
            $table->integer('subkpi_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->foreign('kpi_id')->references('id')->on('kpis');
            $table->foreign('subkpi_id')->references('id')->on('subkpis');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_subkpis_department');
    }
}
