<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsApiInvoiceMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_api_invoice_members', function (Blueprint $table) {
            $table->integer('PKMemberID')->primary();
            $table->integer('FKInvoiceID')->index('FKInvoiceID');
            $table->string('FirstName', 1000)->nullable();
            $table->string('LastName', 1000)->nullable();
            $table->string('EmailAddress', 1000)->nullable();
            $table->string('Address1', 1000)->nullable();
            $table->string('Address2', 1000)->nullable();
            $table->string('Address3', 1000)->nullable();
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
        Schema::dropIfExists('ws_api_invoice_members');
    }
}
