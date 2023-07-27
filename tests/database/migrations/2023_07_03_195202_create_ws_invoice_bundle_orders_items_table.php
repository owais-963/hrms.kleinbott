<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsInvoiceBundleOrdersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_invoice_bundle_orders_items', function (Blueprint $table) {
            $table->integer('PKBundleOrderDetailID')->primary();
            $table->integer('FKInvoiceID')->nullable();
            $table->integer('FKParentInvoiceID')->nullable();
            $table->integer('FKBundleOrderID')->nullable();
            $table->integer('FKMemberID')->nullable();
            $table->integer('FKFranchiseID')->nullable();
            $table->integer('FKServiceID')->nullable();
            $table->integer('FKCategoryID')->nullable();
            $table->string('Title', 255)->nullable();
            $table->integer('TotalQty')->nullable();
            $table->integer('InvoiceQty')->nullable();
            $table->integer('RemainingQty')->nullable();
            $table->integer('Expiry')->nullable();
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
        Schema::dropIfExists('ws_invoice_bundle_orders_items');
    }
}
