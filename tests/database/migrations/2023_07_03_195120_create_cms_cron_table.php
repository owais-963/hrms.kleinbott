<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsCronTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_cron', function (Blueprint $table) {
            $table->integer('PKCronID')->primary();
            $table->string('Cron', 250);
            $table->boolean('Status')->default(0);
            $table->dateTime('CreatedDateTime');
            $table->dateTime('UpdatedDateTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_cron');
    }
}
