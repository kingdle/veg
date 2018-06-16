<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->string('prod_id')->nullable()->comment('产品ID');
            $table->string('counts')->default(1)->comment('数量');
            $table->decimal('price')->nullable()->comment('参考价');
            $table->string('name')->nullable()->comment('收货人');
            $table->string('address')->nullable()->comment('收货地址');
            $table->string('phone')->nullable()->comment('手机');
            $table->string('state')->default(0)->comment('状态');//0买家提交待卖家处理1卖家处理待买家确认2买家确认
            $table->string('note_buy')->nullable()->comment('买家留言');
            $table->string('note_sell')->nullable()->comment('卖家留言');
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
        Schema::dropIfExists('orders');
    }
}
