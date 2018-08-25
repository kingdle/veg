<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynamicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bigcode_dynamics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_id')->unsigned()->index();
            $table->unsignedInteger('user_id')->comment('UserId');
            $table->text('content')->comment('内容');
            $table->string('pic')->nullable()->comment('图片');
            $table->string('is_hidden',8)->default('F')->comment('是否隐藏动态');
            $table->timestamp('published_at');
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
        Schema::dropIfExists('bigcode_dynamics');
    }
}
