<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsPaymentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_payment_informations', function (Blueprint $table) {
            $table->integer('PKInformationID')->primary();
            $table->string('InvoiceNumber', 255)->nullable()->index('InvoiceNumber');
            $table->text('Content')->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_payment_informations');
    }
}
