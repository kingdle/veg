<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleToBigcodeDynamicssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bigcode_dynamics', function (Blueprint $table) {
            $table->text('title')->default(NULL)->after('user_id')->comment('标题');
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
            $table->dropColumn('title');
        });
    }
}
