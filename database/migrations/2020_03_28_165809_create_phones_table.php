<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('用户ID');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('phone')->nullable()->comment('手机');
            $table->string('depart')->nullable()->comment('部门');
            $table->string('appearance')->nullable()->comment('外观');
            $table->string('performance')->nullable()->comment('性能');
            $table->json('changes')->nullable()->comment('改进');
            $table->decimal('idea')->nullable()->comment('意见');
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
        Schema::dropIfExists('phones');
    }
}
