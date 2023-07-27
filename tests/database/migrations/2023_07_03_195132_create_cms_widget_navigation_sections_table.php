<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsWidgetNavigationSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_widget_navigation_sections', function (Blueprint $table) {
            $table->integer('PKNavigationID')->primary();
            $table->integer('FKSectionID')->nullable()->index('FKSectionID');
            $table->integer('FKWidgetID')->nullable()->index('FKWidgetID');
            $table->integer('Position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_widget_navigation_sections');
    }
}
