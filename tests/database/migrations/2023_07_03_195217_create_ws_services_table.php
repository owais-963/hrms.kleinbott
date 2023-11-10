<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_services', function (Blueprint $table) {
            $table->integer('PKServiceID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('OldServiceID')->nullable()->index('OldServiceID');
            $table->integer('FKCategoryID')->index('FKCategoryID');
            $table->string('Title', 2000)->nullable();
            $table->text('Content')->nullable();
            $table->string('DesktopImageName', 500)->nullable();
            $table->string('MobileImageName', 500)->nullable();
            $table->decimal('Price', 10, 2)->nullable();
            $table->integer('Position')->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->nullable()->index('Status');
            $table->enum('IsPackage', ['yes', 'no'])->default('No');
            $table->enum('IsBundle', ['yes', 'no'])->default('No');
            $table->integer('Quantity')->nullable();
            $table->integer('Expiry')->nullable();
            $table->enum('PreferencesShow', ['yes', 'no'])->default('No')->index('PreferencesShow');
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            
            $table->index(['Title`(767'], 'Title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_services');
    }
}
