<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->integer('PKNotificationID')->primary();
            $table->string('Title', 255);
            $table->text('Content');
            $table->enum('Status', ['enabled', 'disabled'])->nullable();
            $table->dateTime('PublishDateTime')->nullable();
            $table->dateTime('LastPublishDateTime')->nullable();
            $table->integer('PublishCount')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
