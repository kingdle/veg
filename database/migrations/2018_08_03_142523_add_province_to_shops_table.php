<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProvinceToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {

            $table->string('language')->default('zh_CN')->after('dynamic_count')->comment('语言');
            $table->string('country')->default('中国')->after('language')->comment('国家');
            $table->string('province')->default('山东省')->after('country')->comment('省份');
            $table->string('legal_person')->nullable()->after('property')->comment('法人姓名');
            $table->string('legal_person_id')->nullable()->after('legal_person')->comment('法人身份证号');
            $table->string('legal_person_id_card')->nullable()->after('legal_person_id')->comment('法人身份证图片链接');
            $table->string('business_license')->nullable()->after('legal_person_id_card')->comment('营业执照号');
            $table->string('business_license_pic')->nullable()->after('business_license')->comment('营业执照号图片链接');

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
            $table->dropColumn('language');
            $table->dropColumn('country');
            $table->dropColumn('province');
            $table->dropColumn('legal_person');
            $table->dropColumn('legal_person_id');
            $table->dropColumn('legal_person_id_card');
            $table->dropColumn('business_license');
            $table->dropColumn('business_license_pic');
        });
    }
}
