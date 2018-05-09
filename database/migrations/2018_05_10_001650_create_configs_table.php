<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('host')->nullable()->comment('服务器地址');
            $table->string('domain')->nullable()->comment('域名');
            $table->string('prefix')->default('veg_')->comment('前缀');
            $table->string('title')->nullable()->comment('标题');
            $table->string('slogan')->nullable()->unique()->comment('宣传语');
            $table->string('slide')->nullable()->unique()->comment('焦点图片');
            $table->string('notice')->nullable()->unique()->comment('公告');
            $table->string('admission')->nullable()->unique()->comment('入驻');
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
        Schema::dropIfExists('configs');
    }
}
