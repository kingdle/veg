<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment')->default(0)->after('state')->comment('是否付款');//0为未付款1为已付款
            $table->string('rate_buyer')->nullable()->after('note_buy')->comment('买家评级');//5级
            $table->string('rate_seller')->nullable()->after('note_sell')->comment('卖家评级');//5级

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
            $table->dropColumn('payment');
            $table->dropColumn('rate_buyer');
            $table->dropColumn('rate_seller');
        });
    }
}
