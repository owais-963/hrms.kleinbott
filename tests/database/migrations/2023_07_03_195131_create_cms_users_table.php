<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_users', function (Blueprint $table) {
            $table->integer('PKUserID')->primary();
            $table->enum('Role', ['administrator', 'driver'])->default('Administrator')->index('Role_2');
            $table->integer('FKWebsiteID')->default(0)->index('FKWebsiteID');
            $table->string('FKFranchiseID', 255)->default('0')->index('Role');
            $table->string('FirstName', 500)->nullable();
            $table->string('LastName', 500)->nullable();
            $table->string('EmailAddress', 500)->nullable()->index('EmailAddress');
            $table->string('Password', 500)->nullable()->index('Password');
            $table->enum('Status', ['enabled', 'disabled'])->index('Status');
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
        Schema::dropIfExists('cms_users');
    }
}
