<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique()->comment('UserId');
            $table->string('title')->comment('苗果昵称');
            $table->text('summary')->comment('简介');
            $table->text('content')->nullable()->comment('内容');
            $table->string('property')->nullable()->comment('性质');
            $table->string('avatar')->nullable()->comment('头像');
            $table->integer('pic_count')->default(0)->comment('相片数');
            $table->integer('dynamic_count')->default(0)->comment('动态数');
            $table->string('address')->comment('所在地址');
            $table->timestamp('published_at')->comment('上线日期');
            $table->string('code')->nullable()->comment('苗果码');
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
        Schema::dropIfExists('shops');
    }
}
