<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsFranchisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_franchises', function (Blueprint $table) {
            $table->integer('PKFranchiseID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->string('Title', 2000)->nullable();
            $table->string('Name', 1000)->nullable();
            $table->string('EmailAddress', 500)->nullable();
            $table->string('Address', 2000)->nullable();
            $table->string('Telephone', 225)->nullable();
            $table->string('Mobile', 225)->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->default('Enabled');
            $table->integer('PickupLimit')->default(1)->index('PickupLimit');
            $table->integer('DeliveryLimit')->default(1)->index('DeliveryLimit');
            $table->string('OpeningTime', 25)->nullable()->index('OpeningTime');
            $table->string('ClosingTime', 25)->nullable()->index('ClosingTime');
            $table->integer('GapTime')->default(1);
            $table->enum('AllowSameTime', ['yes', 'no'])->default('Yes')->index('AllowSameTime');
            $table->enum('DeliveryOption', ['none', 'saturday pickup delivery to monday after 3', 'saturday sunday both pickup delivery to monday after 3', 'saturday sunday both pickup delivery to tuesday'])->default('Saturday Pickup Delivery To Monday After 3');
            $table->integer('PickupDifferenceHour')->default(3);
            $table->integer('DeliveryDifferenceHour')->default(0);
            $table->integer('MinimumOrderAmount')->nullable();
            $table->integer('MinimumOrderAmountLater')->nullable();
            $table->string('OffDays', 1000)->nullable()->index('OffDays');
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            
            $table->index(['MinimumOrderAmount', 'MinimumOrderAmountLater'], 'MinimumOrderAmount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_franchises');
    }
}
