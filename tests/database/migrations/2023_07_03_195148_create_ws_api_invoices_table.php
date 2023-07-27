<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsApiInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_api_invoices', function (Blueprint $table) {
            $table->integer('PKInvoiceID')->primary();
            $table->decimal('SubTotal', 10, 2)->nullable();
            $table->decimal('VATTotal', 10, 2)->nullable();
            $table->decimal('GrandTotal', 10, 2)->nullable();
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
        Schema::dropIfExists('ws_api_invoices');
    }
}
