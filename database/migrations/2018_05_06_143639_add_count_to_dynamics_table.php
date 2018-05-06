<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountToDynamicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynamics', function (Blueprint $table) {
            $table->integer('comments_count')->default(0)->after('pic')->comment('评论数');
            $table->integer('followers_count')->default(1)->after('comments_count')->comment('点赞数');
            $table->integer('answers_count')->default(0)->after('followers_count')->comment('回答数');
            $table->string('close_comment',8)->default('F')->after('answers_count')->comment('是否关闭评论');
            $table->string('is_hidden',8)->default('F')->after('close_comment')->comment('是否隐藏动态');
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
            $table->dropColumn('comments_count');
            $table->dropColumn('followers_count');
            $table->dropColumn('answers_count');
            $table->dropColumn('close_comment');
            $table->dropColumn('is_hidden');
        });
    }
}
