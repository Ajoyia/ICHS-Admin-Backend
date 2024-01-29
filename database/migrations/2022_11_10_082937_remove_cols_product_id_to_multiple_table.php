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
        Schema::table('invoices', function (Blueprint $table) {
            //
            $table->dropForeign('invoices_product_id_foreign');
            $table->dropColumn('product_id');
        });
        Schema::table('receipts', function (Blueprint $table) {
            //
            $table->dropForeign('receipts_product_id_foreign');
            $table->dropColumn('product_id');
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            //
            $table->dropForeign('transaction_details_product_id_foreign');
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned()->nullable()->default(null)->after('id');
            $table->foreign('product_id')->references('id')->on('product_country_type')->onUpdate('set null')->onDelete('set null');
        });
        Schema::table('receipts', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned()->nullable()->default(null)->after('id');
            $table->foreign('product_id')->references('id')->on('product_country_type')->onUpdate('set null')->onDelete('set null');
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned()->nullable()->default(null)->after('id');
            $table->foreign('product_id')->references('id')->on('product_country_type')->onUpdate('set null')->onDelete('set null');
        });
    }
};
