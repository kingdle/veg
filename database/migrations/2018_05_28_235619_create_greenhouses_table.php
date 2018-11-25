<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenhousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greenhouses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->string('title')->nullable()->comment('苗果昵称');
            $table->text('summary')->nullable()->comment('简介');
            $table->text('content')->nullable()->comment('内容');
            $table->string('avatar')->nullable()->comment('头像');
            $table->integer('pic_count')->default(0)->comment('相片数');
            $table->integer('dynamic_count')->default(0)->comment('动态数');
            $table->string('address')->nullable()->comment('所在地址');
            $table->string('cityInfo')->nullable()->comment('城市');
            $table->string('villageInfo')->nullable()->comment('村庄信息');
            $table->string('longitude')->nullable()->comment('经度');
            $table->string('latitude')->nullable()->comment('纬度');
            $table->timestamp('published_at')->nullable()->comment('建设日期');
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
        Schema::dropIfExists('greenhouses');
    }
}
