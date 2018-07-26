<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsServiceToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->string('is_service')->default('F')->after('is_hidden')->comment('是否客服店铺');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn('is_service');
        });
    }
}
