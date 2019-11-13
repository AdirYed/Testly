<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrivingLicenseTypeQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_license_type_question', function (Blueprint $table) {
            $table->unsignedBigInteger('driving_license_type_id');
            $table->unsignedBigInteger('question_id');

            $table->foreign('driving_license_type_id')->references('id')
                ->on('driving_license_types')
                ->onDelete('cascade');
            $table->foreign('question_id')->references('id')
                ->on('questions')
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
        Schema::dropIfExists('driving_license_type_question');
    }
}
