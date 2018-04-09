<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeixinToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('id');
            $table->string('openid')->nullable()->after('username');
            $table->string('nickname')->nullable()->after('openid');
            $table->string('avatar_url')->nullable()->after('nickname');
            $table->integer('gender')->default(1)->after('avatar_url');
            $table->string('city')->nullable()->after('gender');
            $table->string('session')->nullable()->after('remember_token');
            $table->string('session_key')->nullable()->after('session');
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
            $table->dropColumn('username');
            $table->dropColumn('openid');
            $table->dropColumn('nickname');
            $table->dropColumn('avatar_url');
            $table->dropColumn('gender');
            $table->dropColumn('city');
            $table->dropColumn('session');
            $table->dropColumn('session_key');
        });
    }
}
