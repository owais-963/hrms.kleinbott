<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsInvoiceServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_invoice_services', function (Blueprint $table) {
            $table->integer('PKInvoiceServiceID')->primary();
            $table->integer('FKInvoiceID');
            $table->integer('FKCategoryID')->default(0)->index('FKCategoryID');
            $table->integer('FKServiceID');
            $table->string('Title', 1000)->nullable();
            $table->text('ImageURL')->nullable();
            $table->text('DesktopImageName')->nullable();
            $table->text('MobileImageName')->nullable();
            $table->enum('IsPackage', ['yes', 'no'])->default('No')->index('IsPackage');
            $table->enum('IsBundle', ['yes', 'no'])->default('No');
            $table->enum('PreferencesShow', ['yes', 'no'])->default('No')->index('PreferencesShow');
            $table->integer('Quantity')->nullable();
            $table->decimal('Price', 10, 2)->nullable();
            $table->decimal('Total', 10, 2)->nullable();
            
            $table->index(['FKInvoiceID', 'FKServiceID'], 'FKInvoiceID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_invoice_services');
    }
}
