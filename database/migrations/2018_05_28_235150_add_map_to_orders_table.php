<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMapToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('cityInfo')->nullable()->after('address')->comment('城市');
            $table->string('villageInfo')->nullable()->after('cityInfo')->comment('村庄信息');
            $table->string('longitude')->nullable()->after('villageInfo')->comment('经度');
            $table->string('latitude')->nullable()->after('longitude')->comment('纬度');
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
            $table->dropColumn('cityInfo');
            $table->dropColumn('villageInfo');
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
        });
    }
}
