<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBtnTitleToConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('btn_register')->default('F')->after('shop_circular')->comment('入驻发动态');
            $table->string('btn_order')->default('F')->after('btn_register')->comment('下订单');
            $table->string('btn_love')->default('F')->after('btn_order')->comment('点赞');
            $table->string('btn_follower')->default('F')->after('btn_love')->comment('收藏');
            $table->string('btn_comment')->default('F')->after('btn_follower')->comment('评论');
            $table->string('btn_answer')->default('F')->after('btn_comment')->comment('回复');
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
            $table->dropColumn('btn_register');
            $table->dropColumn('btn_order');
            $table->dropColumn('btn_love');
            $table->dropColumn('btn_follower');
            $table->dropColumn('btn_comment');
            $table->dropColumn('btn_answer');
        });
    }
}
