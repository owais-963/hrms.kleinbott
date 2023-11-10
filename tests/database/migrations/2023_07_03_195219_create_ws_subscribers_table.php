<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_subscribers', function (Blueprint $table) {
            $table->integer('PKSubscriberID')->primary();
            $table->string('EmailAddress', 500)->nullable();
            $table->string('Source', 200)->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->default('Enabled');
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
        Schema::dropIfExists('ws_subscribers');
    }
}
