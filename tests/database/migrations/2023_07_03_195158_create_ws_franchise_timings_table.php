<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsFranchiseTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_franchise_timings', function (Blueprint $table) {
            $table->integer('FKFranchiseID')->nullable();
            $table->integer('PickupLimit')->nullable();
            $table->integer('DeliveryLimit')->nullable();
            $table->string('OpeningTime', 75)->nullable();
            $table->string('ClosingTime', 75)->nullable();
            $table->integer('GapTime')->default(1);
            $table->timestamp('created_at')->default('current_timestamp()');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_franchise_timings');
    }
}
