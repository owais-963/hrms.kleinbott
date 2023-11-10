<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsLoyaltyPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_loyalty_points', function (Blueprint $table) {
            $table->integer('PKLoyaltyID')->primary();
            $table->integer('FKMemberID')->index('FKMemberID');
            $table->integer('FKInvoiceID')->index('FKInvoiceID');
            $table->string('InvoiceNumber', 50)->index('InvoiceNumber');
            $table->decimal('GrandTotal', 10, 2)->nullable();
            $table->integer('Points');
            $table->dateTime('CreatedDateTime')->nullable();
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
        Schema::dropIfExists('ws_loyalty_points');
    }
}
