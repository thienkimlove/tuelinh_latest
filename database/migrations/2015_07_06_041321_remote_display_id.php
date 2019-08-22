<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoteDisplayId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('display_id');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('display_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('display_id')->unique();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('display_id')->unique();
        });
    }
}
