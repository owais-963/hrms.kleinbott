<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_hotels', function (Blueprint $table) {
            $table->integer('hotelId')->primary();
            $table->string('title', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('postcode', 100)->nullable();
            $table->string('latlang', 255)->nullable();
            $table->string('lat', 255)->nullable();
            $table->string('lag', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->enum('status', ['enabled', 'disabled'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_hotels');
    }
}
