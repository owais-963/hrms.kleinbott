<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_devices', function (Blueprint $table) {
            $table->integer('PKDeviceID')->primary();
            $table->text('Name')->nullable();
            $table->text('Platform')->nullable();
            $table->text('UUID')->nullable();
            $table->text('Version')->nullable();
            $table->text('PushID')->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
            $table->enum('IsUpdated', ['yes', 'no'])->default('No');
            $table->dateTime('UpdatedDateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_devices');
    }
}
