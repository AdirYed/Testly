<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('token');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['token', 'type']);
            $table->foreign('user_id')->references('id')
                ->on('users')
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
        Schema::dropIfExists('url_tokens');
    }
}
