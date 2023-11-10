<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsDisableTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_disable_time_slots', function (Blueprint $table) {
            $table->integer('PKTimeID')->primary();
            $table->integer('FKFranchiseID')->nullable()->index('FKFranchiseID');
            $table->integer('FKDateID')->nullable()->index('FKDateID');
            $table->date('Date')->nullable()->index('Date');
            $table->string('Time', 100)->index('Time');
            $table->enum('Type', ['both', 'pickup', 'delivery'])->default('Both')->index('Type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_disable_time_slots');
    }
}
