<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenCountToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->integer('click_count')->default(1)->after('comments_count')->comment('点击数');
            $table->integer('is_true')->default(0)->after('close_comment')->comment('是否认证0未认证1提交中2已认证');
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
            $table->dropColumn('click_count');
            $table->dropColumn('is_true');
        });
    }
}
