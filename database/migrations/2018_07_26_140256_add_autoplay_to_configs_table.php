<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutoplayToConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('header_indicator_dots')->default('true')->after('admission')->comment('头部指示点');
            $table->string('header_auto_play')->default('true')->after('header_indicator_dots')->comment('头部自动播放');
            $table->string('header_interval')->default('3000')->after('header_auto_play')->comment('头部时间间隔');
            $table->string('header_duration')->default('500')->after('header_interval')->comment('头部滑动期间');
            $table->string('header_circular')->default('true')->after('header_duration')->comment('头部环绕播放');
            $table->string('shop_indicator_dots')->default('false')->after('header_circular')->comment('苗厂列表指示点');
            $table->string('shop_auto_play')->default('true')->after('shop_indicator_dots')->comment('苗厂列表自动播放');
            $table->string('shop_interval')->default('5000')->after('shop_auto_play')->comment('苗厂列表时间间隔');
            $table->string('shop_duration')->default('500')->after('shop_interval')->comment('苗厂列表滑动期间');
            $table->string('shop_circular')->default('true')->after('shop_duration')->comment('苗厂列表环绕播放');
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
            $table->dropColumn('header_indicator_dots');
            $table->dropColumn('header_auto_play');
            $table->dropColumn('header_interval');
            $table->dropColumn('header_duration');
            $table->dropColumn('header_circular');
            $table->dropColumn('shop_indicator_dots');
            $table->dropColumn('shop_auto_play');
            $table->dropColumn('shop_interval');
            $table->dropColumn('shop_duration');
            $table->dropColumn('shop_circular');
        });
    }
}
