<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionReviewCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_review_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('submission_status_id')->unsigned();
            $table->integer('reviewer_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->text('comment');
            $table->foreign('submission_status_id')->references('id')->on('user_submission_status');
            $table->foreign('reviewer_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('status');
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
        Schema::dropIfExists('submission_review_comments');
    }
}
