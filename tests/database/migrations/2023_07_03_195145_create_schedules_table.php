<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('member_id');
            $table->integer('franchise_id');
            $table->integer('device_id')->nullable();
            $table->string('address', 255);
            $table->string('address2', 255);
            $table->string('postcode', 255);
            $table->string('town', 255)->nullable();
            $table->integer('schedule');
            $table->string('pickup_time', 255);
            $table->integer('card_id');
            $table->string('status', 50)->default('active');
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
        Schema::dropIfExists('schedules');
    }
}
