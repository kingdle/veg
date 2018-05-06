<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBioToTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('name')->comment('说明');
            $table->string('pic')->nullable()->after('bio')->comment('图片');
            $table->integer('dynamics_count')->default(0)->after('pic')->comment('动态数');
            $table->integer('followers_count')->default(0)->after('dynamics_count')->comment('点赞数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('bio');
            $table->dropColumn('pic');
            $table->dropColumn('dynamics_count');
            $table->dropColumn('followers_count');
        });
    }
}
