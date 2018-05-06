<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortIdToDynamicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynamics', function (Blueprint $table) {
            $table->unsignedInteger('sort_id')->nullable()->after('shop_id')->comment('分类ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dynamics', function (Blueprint $table) {
            $table->dropColumn('sort_id');
        });
    }
}
