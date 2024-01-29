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
        Schema::table('cme_applications', function (Blueprint $table) {
            //
            $table->bigInteger('cme_product_id')->unsigned()->nullable()->default(null)->after('country_id');
            $table->foreign('cme_product_id')->references('id')->on('cme_products')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_applications', function (Blueprint $table) {
            //
            $table->dropForeign('cme_applications_cme_product_id_foreign');
            $table->dropColumn('cme_product_id');
        });
    }
};
