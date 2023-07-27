<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsInvoiceBundleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_invoice_bundle_orders', function (Blueprint $table) {
            $table->integer('PKBundleOrderID')->primary();
            $table->integer('FKInvoiceID');
            $table->integer('FKMemberID');
            $table->integer('FKServiceID');
            $table->integer('FKCategoryID')->nullable();
            $table->integer('FKFranchiseID');
            $table->string('Title', 255)->nullable();
            $table->integer('TotalQty')->nullable();
            $table->integer('InvoiceQty')->nullable();
            $table->integer('RemainigQty')->nullable();
            $table->integer('Expiry')->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->enum('Status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_invoice_bundle_orders');
    }
}
