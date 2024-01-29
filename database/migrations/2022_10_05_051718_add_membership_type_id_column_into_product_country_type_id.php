<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_country_type', function (Blueprint $table) {
            $table->bigInteger('membership_type_id')->unsigned()->nullable()->default(null)->after('product_id');
            $table->foreign('membership_type_id')->references('id')->on('membership_types')->onUpdate('set null')->onDelete('set null');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_country_type', function (Blueprint $table) {
           $table->dropForeign(['membership_type_id']);
           $table->dropColumn(['membership_type_id']);
        });
    }
};
