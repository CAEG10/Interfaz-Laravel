<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->string('temperatura');
            $table->timestamp('date');
        });

        Schema::create('s1_temp', function (Blueprint $table) {
            $table->id();
            $table->string('temperatura');
            $table->timestamp('date');
        });

        Schema::create('s1_hum', function (Blueprint $table) {
            $table->id();
            $table->string('humedad');
            $table->timestamp('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charts');
        Schema::dropIfExists('s1_temp');
        Schema::dropIfExists('s1_hum');
    }
};
