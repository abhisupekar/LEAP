<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSubkpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('subkpis', function (Blueprint $table) {
          $table->decimal('min', 6, 2);
          $table->decimal('max', 6, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('subkpis', function (Blueprint $table) {
          $table->dropColumn(['min', 'max']);
        });
    }
}
