<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsDisableDateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_disable_date_slots', function (Blueprint $table) {
            $table->integer('PKDateID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('FKFranchiseID')->default(0)->index('FKFranchiseID');
            $table->date('DisableDateFrom')->nullable()->index('DisableDateFrom');
            $table->date('DisableDateTo')->nullable()->index('DisableDateTo');
            $table->enum('Type', ['both', 'pickup', 'delivery'])->default('Both')->index('Type');
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_disable_date_slots');
    }
}
