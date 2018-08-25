<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceToBigcodeDynamicssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bigcode_dynamics', function (Blueprint $table) {

            $table->decimal('price')->nullable()->after('pic')->comment('单价');
            $table->decimal('total_price')->nullable()->after('price')->comment('总价');
            $table->string('counts')->default(1)->after('total_price')->comment('数量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bigcode_dynamics', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('total_price');
            $table->dropColumn('counts');
        });
    }
}
