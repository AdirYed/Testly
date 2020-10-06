<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToNullableToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('first_name')->nullable()->change();
          $table->string('last_name')->nullable()->change();
          $table->dropUnique(['email']);
          $table->string('email')->unique()->nullable()->change();
          $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('first_name')->nullable(false)->change();
          $table->string('last_name')->nullable(false)->change();
          $table->dropUnique(['email']);
          $table->string('email')->unique()->nullable(false)->change();
          $table->string('password')->nullable(false)->change();
        });
    }
}
