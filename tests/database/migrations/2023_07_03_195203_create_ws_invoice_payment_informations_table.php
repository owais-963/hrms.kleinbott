<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsInvoicePaymentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_invoice_payment_informations', function (Blueprint $table) {
            $table->integer('PKInvoicePaymentID')->primary();
            $table->integer('FKInvoiceID');
            $table->integer('FKCardID')->nullable();
            $table->decimal('Amount', 10, 2)->nullable();
            $table->text('PaymentReference')->nullable();
            $table->text('PaymentToken')->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
            
            $table->index(['FKInvoiceID', 'FKCardID'], 'FKInvoiceID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_invoice_payment_informations');
    }
}
