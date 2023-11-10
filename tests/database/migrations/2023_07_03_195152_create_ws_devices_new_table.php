<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsDevicesNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_devices_new', function (Blueprint $table) {
            $table->increments('PKDeviceID');
            $table->integer('FKMemberID')->nullable()->index('LastLoginID');
            $table->text('ID')->nullable();
            $table->text('PushID')->nullable();
            $table->string('Model', 1000)->nullable();
            $table->enum('Platform', ['unknown', 'android', 'ios'])->default('Unknown')->index('Platform');
            $table->string('Version', 30)->nullable()->index('Version');
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('ActiveDateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_devices_new');
    }
}
