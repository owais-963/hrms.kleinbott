<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPageAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_page_areas', function (Blueprint $table) {
            $table->integer('PKPageAreaID')->primary();
            $table->integer('FKPageID')->index('FKPageID');
            $table->integer('FKAreaDetailID')->index('FKAreaDetailID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_page_areas');
    }
}
