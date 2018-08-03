<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBtnRegisterNameToConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('btnRegisterName')->default('F')->after('btn_register')->comment('入驻按钮名称');
            $table->string('btnOrderName')->default('F')->after('btn_order')->comment('订单按名称');
            $table->string('btnLoveName')->default('F')->after('btn_love')->comment('收藏按钮名称');
            $table->string('btnFollowerName')->default('F')->after('btn_follower')->comment('关注按钮名称');
            $table->string('btnCommentName')->default('F')->after('btn_comment')->comment('评论按钮名称');
            $table->string('btnAnswerName')->default('F')->after('btn_answer')->comment('回复按钮名称');
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
            $table->dropColumn('btnRegisterName');
            $table->dropColumn('btnOrderName');
            $table->dropColumn('btnLoveName');
            $table->dropColumn('btnFollowerName');
            $table->dropColumn('btnCommentName');
            $table->dropColumn('btnAnswerName');
        });
    }
}
