<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
           $table->dropColumn('slug');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
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
            $table->string('slug')->unique();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
    }
}
