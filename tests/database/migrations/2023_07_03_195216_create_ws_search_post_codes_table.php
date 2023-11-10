<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsSearchPostCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_search_post_codes', function (Blueprint $table) {
            $table->increments('PKSearchID');
            $table->integer('FKDeviceID')->nullable()->index('FKDeviceID');
            $table->unsignedInteger('FKFranchiseID')->nullable()->index();
            $table->string('Code', 225)->index();
            $table->string('IPAddress', 100)->nullable()->index('IPAddress');
            $table->dateTime('CreatedDateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_search_post_codes');
    }
}
