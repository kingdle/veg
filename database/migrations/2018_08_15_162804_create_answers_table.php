<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned()->comment('用户id');
            $table->integer('dynamic_id')->index()->unsigned()->comment('动态id');
            $table->text('body')->comment('评论内容');
            $table->integer('votes_count')->default(0)->comment('赞成数量');
            $table->integer('comments_count')->default(0)->comment('回复数量');
            $table->string('is_hidden',8)->default('F')->comment('隐藏回复');
            $table->string('close_comment',8)->default('F')->comment('关闭评论');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
