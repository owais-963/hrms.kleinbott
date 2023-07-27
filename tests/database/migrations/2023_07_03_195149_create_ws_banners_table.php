<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_banners', function (Blueprint $table) {
            $table->integer('PKBannerID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->text('Title')->nullable();
            $table->text('Content')->nullable();
            $table->string('ImageName', 500)->nullable();
            $table->integer('Position');
            $table->text('Link')->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->index('Status');
            $table->dateTime('CreatedDateTime');
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
        Schema::dropIfExists('ws_banners');
    }
}
