<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsReadToAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedInteger('to_user_id')->nullable()->after('user_id')->comment('接收人ID');
            $table->string('is_read')->default('F')->after('is_hidden')->comment('是否已读F未读T已读');
            $table->timestamp('read_at')->nullable()->after('is_read')->comment('读时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn('to_user_id');
            $table->dropColumn('is_read');
            $table->dropColumn('read_at');
        });
    }
}
