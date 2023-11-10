<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsMemberCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_member_cards', function (Blueprint $table) {
            $table->integer('PKCardID')->primary();
            $table->integer('FKMemberID')->nullable()->index('FKMemberID');
            $table->string('Title', 2000)->nullable();
            $table->string('Name', 2000)->nullable();
            $table->string('Number', 2000)->nullable();
            $table->string('Year', 25)->nullable();
            $table->string('Month', 25)->nullable();
            $table->string('Code', 2000)->nullable();
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
        Schema::dropIfExists('ws_member_cards');
    }
}
