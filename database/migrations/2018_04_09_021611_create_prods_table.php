<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id')->comment('店Id');
            $table->string('sort_id')->comment('分类ID');
            $table->string('title')->nullable()->comment('商品名');
            $table->string('introduce')->nullable()->comment('介绍');
            $table->string('pic')->nullable()->comment('图片');
            $table->decimal('unit_prince')->nullable()->comment('单价');
            $table->integer('comments_count')->default(0)->comment('评论数');
            $table->integer('likes_count')->default(0)->comment('点赞数');
            $table->integer('followers_count')->default(0)->comment('收藏数');
            $table->timestamp('published_at')->comment('发布时间');
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
        Schema::dropIfExists('prods');
    }
}
