<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestReportAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_report_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('test_report_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->timestamps();

            $table->foreign('question_id')->references('id')
                ->on('questions')
                ->onDelete('cascade');
            $table->foreign('test_report_id')->references('id')
                ->on('test_reports')
                ->onDelete('cascade');
            $table->foreign('answer_id')->references('id')
                ->on('answers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_report_answers');
    }
}
