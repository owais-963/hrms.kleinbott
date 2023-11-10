<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_preferences', function (Blueprint $table) {
            $table->integer('PKPreferenceID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('OldPreferenceID')->nullable()->index('OldPreferenceID');
            $table->integer('ParentPreferenceID')->default(0)->index('ParentPreferenceID');
            $table->text('Title')->nullable();
            $table->decimal('Price', 10, 2)->nullable();
            $table->integer('Position')->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->index('Status');
            $table->enum('PriceForPackage', ['yes', 'no'])->default('No');
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_preferences');
    }
}
