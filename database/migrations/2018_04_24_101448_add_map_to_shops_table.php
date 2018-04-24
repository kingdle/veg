<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMapToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->string('cityInfo')->nullable()->after('dynamic_count')->comment('城市');
            $table->string('longitude')->nullable()->after('address')->comment('经度');
            $table->string('latitude')->nullable()->after('longitude')->comment('纬度');
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
            $table->dropColumn('cityInfo');
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
        });
    }
}
