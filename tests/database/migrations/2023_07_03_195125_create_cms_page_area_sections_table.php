<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPageAreaSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_page_area_sections', function (Blueprint $table) {
            $table->integer('PKSectionID')->primary();
            $table->integer('FKPageID')->index('FKPageID');
            $table->string('Title', 3000)->nullable();
            $table->text('Content')->nullable();
            $table->string('ImageName', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_page_area_sections');
    }
}
