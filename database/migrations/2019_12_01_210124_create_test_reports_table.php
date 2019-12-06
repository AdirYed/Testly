<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('started_at');
            $table->timestamp('finished_at');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('driving_license_type_id');
            $table->timestamps();

            $table->foreign('driving_license_type_id')->references('id')
                ->on('driving_license_types')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_reports');
    }
}
