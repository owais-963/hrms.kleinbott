<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_testimonials', function (Blueprint $table) {
            $table->integer('PKTestimonialID')->primary();
            $table->integer('FKWebsiteID')->default(1)->index('FKWebsiteID');
            $table->integer('FKFranchiseID')->default(0);
            $table->string('Title', 2000)->nullable();
            $table->string('Name', 1000)->nullable();
            $table->string('EmailAddress', 225)->nullable();
            $table->text('Content')->nullable();
            $table->date('TestimonialDate')->nullable();
            $table->integer('Rating')->default(1);
            $table->enum('Status', ['enabled', 'disabled'])->default('Enabled');
            $table->dateTime('CreatedDateTime');
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
        Schema::dropIfExists('ws_testimonials');
    }
}
