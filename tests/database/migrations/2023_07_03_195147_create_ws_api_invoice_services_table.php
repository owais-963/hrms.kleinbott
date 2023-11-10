<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsApiInvoiceServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_api_invoice_services', function (Blueprint $table) {
            $table->integer('PKInvoiceServiceID')->primary();
            $table->integer('FKInvoiceID')->index('FKInvoiceID');
            $table->string('Title', 2000)->nullable();
            $table->string('AppointmentTime', 1000)->nullable();
            $table->string('AppointmentDate', 1000)->nullable();
            $table->integer('Quantity')->nullable();
            $table->decimal('Price', 10, 2)->nullable();
            $table->decimal('Total', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_api_invoice_services');
    }
}
