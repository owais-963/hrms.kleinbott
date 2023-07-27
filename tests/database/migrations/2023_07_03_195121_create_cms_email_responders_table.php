<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsEmailRespondersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_email_responders', function (Blueprint $table) {
            $table->integer('PKResponderID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->text('Title')->nullable();
            $table->text('FromEmail')->nullable();
            $table->text('ToEmail')->nullable();
            $table->text('Subject')->nullable();
            $table->text('Content')->nullable();
            $table->enum('Status', ['enabled', 'disabled'])->index('Status');
            $table->dateTime('CreatedDateTime')->nullable();
            $table->dateTime('UpdatedDateTime');
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
        Schema::dropIfExists('cms_email_responders');
    }
}
