<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewsTitleToConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('newsTitle')->nullable()->after('slogan')->comment('动态标题');
            $table->string('newsSlogan')->nullable()->after('newsTitle')->comment('动态标题下的文字');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->dropColumn('newsTitle');
            $table->dropColumn('newsSlogan');
        });
    }
}
