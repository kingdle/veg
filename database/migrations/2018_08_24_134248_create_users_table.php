<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bigcode_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('nickname')->unique();
            $table->integer('gender')->default(1);
            $table->string('phone')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('weapp_openid')->nullable()->unique();
            $table->string('weixin_session_key')->nullable();
            $table->string('avatar')->nullable();
            $table->string('country')->default('中国')->comment('国家');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('城市');
            $table->string('language')->default('zh_CN')->comment('语言');
            $table->string('confirmation_token')->nullable();
            $table->smallInteger('is_active')->default(0);
            $table->integer('questions_count')->default(0);
            $table->integer('answer_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->integer('followers_count')->default(0);
            $table->integer('followings_count')->default(0);
            $table->json('setting')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('bigcode_users');
    }
}
