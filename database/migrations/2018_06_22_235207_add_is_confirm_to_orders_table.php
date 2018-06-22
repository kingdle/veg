<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsConfirmToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('is_confirm')->default(0)->after('payment_at')->comment('确认状态0菜农发起1苗厂2菜农确认');
            $table->timestamp('buyer_at')->nullable()->after('is_confirm')->comment('菜农小程序提交时间');
            $table->timestamp('seller_at')->nullable()->after('buyer_at')->comment('苗厂确认时间');
            $table->timestamp('buyer_confirm_at')->nullable()->after('seller_at')->comment('菜农小程序确认时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_confirm');
            $table->dropColumn('buyer_at');
            $table->dropColumn('seller_at');
            $table->dropColumn('buyer_confirm_at');
        });
    }
}
