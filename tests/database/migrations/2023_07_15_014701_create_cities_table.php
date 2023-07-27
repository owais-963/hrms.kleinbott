<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 255);
            $table->unsignedMediumInteger('state_id');
            $table->string('state_code', 255);
            $table->unsignedMediumInteger('country_id');
            $table->char('country_code', 2);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps()->default('2014-01-01 06:31:01');
            $table->boolean('flag')->default(1);
            $table->string('wikiDataId', 255)->nullable()->comment("Rapid API GeoDB Cities");
            
            $table->foreign('state_id', 'cities_ibfk_1')->references('id')->on('states');
            $table->foreign('country_id', 'cities_ibfk_2')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
