<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsFranchiseServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_franchise_services', function (Blueprint $table) {
            $table->integer('PKFranchiseServiceID')->primary();
            $table->decimal('Price', 10, 2)->nullable();
            $table->string('Title', 2000)->nullable();
            $table->string('DiscountPercentage', 200)->default('0')->comment("value in percentae");
            $table->integer('FKFranchiseID')->nullable();
            $table->integer('FKServiceID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_franchise_services');
    }
}
