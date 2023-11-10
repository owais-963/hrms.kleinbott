<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_admin_menus', function (Blueprint $table) {
            $table->integer('PKAdminMenuID')->primary();
            $table->integer('ParentMenuID')->default(0)->index('ParentMenuID');
            $table->integer('FKUserID')->nullable()->index('FKUserID');
            $table->integer('FKMenuID')->nullable()->index('FKMenuID');
            $table->integer('Position')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_admin_menus');
    }
}
