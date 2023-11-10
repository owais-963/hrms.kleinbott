<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsMemberPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_member_preferences', function (Blueprint $table) {
            $table->integer('PKMemberPreferenceID')->primary();
            $table->integer('FKMemberID')->nullable()->index('FKMemberID');
            $table->integer('FKPreferenceID')->nullable()->index('FKPreferenceID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_member_preferences');
    }
}
