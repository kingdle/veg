<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('UserId');
            $table->string('title')->unique()->comment('单位名称');
            $table->string('property')->nullable()->comment('所属行业');
            $table->text('content')->nullable()->comment('经营内容');
            $table->string('phone')->nullable()->comment('手机');
            $table->string('web_url')->nullable()->comment('网址');
            $table->string('remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('seeds');
    }
}
