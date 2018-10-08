<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->unsignedInteger('shop_id')->nullable()->comment('ShopId');
            $table->unsignedInteger('dynamic_id')->nullable()->comment('动态ID');
            $table->text('video_thumbnail')->nullable()->comment('缩略图');
            $table->text('video_url')->nullable()->comment('视频链接');
            $table->string('video_height')->nullable()->comment('视频高度');
            $table->string('video_width')->nullable()->comment('视频宽度');
            $table->string('video_size')->nullable()->comment('视频大小');
            $table->string('video_duration')->nullable()->comment('视频长度');
            $table->integer('clicks_count')->default(0)->comment('查看数量');
            $table->integer('comments_count')->default(0)->comment('回复数量');
            $table->string('is_hidden',8)->default('F')->comment('隐藏');
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
        Schema::dropIfExists('videos');
    }
}
