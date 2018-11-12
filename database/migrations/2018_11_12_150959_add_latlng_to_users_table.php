<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatlngToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('district')->nullable()->after('city')->comment('区');
            $table->string('town')->nullable()->after('district')->comment('镇街');
            $table->string('address')->nullable()->after('town')->comment('地址');
            $table->string('villageInfo')->nullable()->after('address')->comment('村');
            $table->string('latitude')->nullable()->after('villageInfo')->comment('纬度');
            $table->string('longitude')->nullable()->after('latitude')->comment('经度');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('district');
            $table->dropColumn('town');
            $table->dropColumn('address');
            $table->dropColumn('villageInfo');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
