<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->integer('PKPageID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('OldPageID')->nullable()->index('OldPageID');
            $table->enum('Template', ['none', 'area', 'area detail', 'commercial'])->default('None')->index('Template');
            $table->text('MetaTitle')->nullable();
            $table->text('MetaKeyword')->nullable();
            $table->text('MetaDescription')->nullable();
            $table->text('Title')->nullable();
            $table->text('Content')->nullable();
            $table->string('HeaderImageName', 500)->nullable();
            $table->text('AccessURL')->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->default('Enabled')->index('Status');
            $table->enum('IsPermanentRedirect', ['yes', 'no'])->default('No');
            $table->text('PermanentRedirectURL')->nullable();
            $table->string('HeaderTitle', 3000)->nullable();
            $table->string('Latitude', 1000)->nullable();
            $table->string('Longitude', 1000)->nullable();
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->enum('NoIndexFollowTag', ['yes', 'no'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_pages');
    }
}
