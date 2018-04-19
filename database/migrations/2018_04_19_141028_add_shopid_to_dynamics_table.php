<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShopidToDynamicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynamics', function (Blueprint $table) {
            $table->unsignedInteger('shop_id')->nullable()->after('user_id')->comment('店铺ID');
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
            $table->dropColumn('shop_id');
        });
    }
}
