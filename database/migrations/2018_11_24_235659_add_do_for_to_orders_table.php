<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDoForToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('do_for')->nullable()->after('is_confirm')->comment('是否代育0否1是');
            $table->decimal('fee_earnest')->nullable()->after('price')->comment('定金');
            $table->timestamp('fee_earnest_at')->nullable()->after('fee_earnest')->comment('定金支付时间');
            $table->decimal('fee_actual')->nullable()->after('fee_earnest_at')->comment('实际付款');
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
            $table->dropColumn('do_for');
            $table->dropColumn('fee_earnest');
            $table->dropColumn('fee_earnest_at');
            $table->dropColumn('fee_actual');
        });
    }
}
