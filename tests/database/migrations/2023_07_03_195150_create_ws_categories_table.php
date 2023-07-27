<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_categories', function (Blueprint $table) {
            $table->integer('PKCategoryID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('OldCategoryID')->nullable()->index('OldCategoryID');
            $table->string('Title', 2000)->nullable();
            $table->string('MobileTitle', 2000)->nullable();
            $table->string('DesktopIconClassName', 500)->nullable();
            $table->string('MobileImageName', 500)->nullable();
            $table->string('MobileIcon', 500)->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->index('Status');
            $table->integer('Position')->nullable();
            $table->enum('PreferencesShow', ['yes', 'no'])->default('No')->index('PreferencesShow');
            $table->string('PopupMessage', 4000)->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            
            $table->index(['Title`(767'], 'Title');
            $table->index(['MobileTitle`(767'], 'MobileTitle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_categories');
    }
}
