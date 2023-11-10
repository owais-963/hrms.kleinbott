<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsInvoicePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_invoice_preferences', function (Blueprint $table) {
            $table->integer('PKInvoicePreferenceID')->primary();
            $table->integer('FKInvoiceID')->nullable()->index('FKInvoiceID');
            $table->integer('FKPreferenceID')->nullable()->index('FKPreferenceID');
            $table->text('ParentTitle')->nullable();
            $table->text('Title')->nullable();
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
        Schema::dropIfExists('ws_invoice_preferences');
    }
}
