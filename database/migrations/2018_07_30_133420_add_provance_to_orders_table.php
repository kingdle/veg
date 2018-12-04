<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProvanceToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('provinceName')->nullable()->after('address')->comment('省');
            $table->string('countyName')->nullable()->after('cityInfo')->comment('县级市');
            $table->text('detailInfo')->nullable()->after('countyName')->comment('详细地址');
            $table->renameColumn('cityInfo', 'cityName')->comment('市');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('provinceName');
            $table->dropColumn('countyName');
            $table->dropColumn('detailInfo');
            $table->renameColumn('cityName', 'cityInfo');

        });
    }
}
