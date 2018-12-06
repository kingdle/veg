<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShopIdToGreenhousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greenhouses', function (Blueprint $table) {
            $table->string('shop_id')->nullable()->after('user_id')->comment('服务苗厂ID');
            $table->string('phone')->nullable()->after('title')->comment('大棚电话');
            $table->string('country')->nullable()->after('address')->comment('国家');
            $table->string('province')->nullable()->after('country')->comment('省');
            $table->string('district')->nullable()->after('city')->comment('区');
            $table->string('town')->nullable()->after('district')->comment('镇街');
            $table->string('is_true')->default('F')->after('code')->comment('是否农户确认');
            $table->string('is_hidden')->default('F')->after('is_true')->comment('是否隐藏');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('greenhouses', function (Blueprint $table) {
            $table->dropColumn('shop_id');
            $table->dropColumn('phone');
            $table->dropColumn('country');
            $table->dropColumn('district');
            $table->dropColumn('town');
            $table->dropColumn('is_true');
            $table->dropColumn('is_hidden');
        });
    }
}
