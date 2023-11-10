<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsNavigationSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_navigation_sections', function (Blueprint $table) {
            $table->integer('PKSectionID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->text('Title')->nullable();
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
        Schema::dropIfExists('cms_navigation_sections');
    }
}
