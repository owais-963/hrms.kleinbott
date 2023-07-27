<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_navigations', function (Blueprint $table) {
            $table->integer('PKNavigationID')->primary();
            $table->integer('FKSectionID')->index('FKSectionID');
            $table->integer('FKPageID')->default(0)->index('FKPageID');
            $table->text('Name')->nullable();
            $table->enum('LinkWith', ['page', 'url']);
            $table->text('LinkWithURL')->nullable();
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
        Schema::dropIfExists('cms_navigations');
    }
}
