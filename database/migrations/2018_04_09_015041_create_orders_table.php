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
            $table->string('prod_id')->comment('产品ID');
            $table->string('count')->default(1)->comment('数量');
            $table->decimal('price')->comment('总价');
            $table->string('name')->comment('收货人');
            $table->string('address')->comment('收货地址');
            $table->string('phone')->comment('手机');
            $table->string('state')->comment('状态');//0买家提交待卖家处理1卖家处理待买家确认2买家确认
            $table->string('note_buy')->comment('买家留言');
            $table->string('note_sell')->comment('卖家留言');
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
