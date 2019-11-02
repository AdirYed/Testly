<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content');
            $table->boolean('is_correct')->default(false);
            $table->unsignedBigInteger('question_id')->index();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
