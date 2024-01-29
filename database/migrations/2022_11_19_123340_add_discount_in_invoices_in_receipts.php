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
            $table->double('discount')->after('total_amount')->default(0)->nullable();
            $table->bigInteger('promo_code_id')->unsigned()->nullable()->default(null);
            $table->foreign('promo_code_id')->references('id')->on('promotion_codes')->onUpdate('set null')->onDelete('set null');
        });

        Schema::table('receipts', function (Blueprint $table) {
            $table->double('discount')->after('total_amount')->default(0)->nullable();
            $table->bigInteger('promo_code_id')->unsigned()->nullable()->default(null);
            $table->foreign('promo_code_id')->references('id')->on('promotion_codes')->onUpdate('set null')->onDelete('set null');
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
           $table->dropForeign(['promo_code_id']);
           $table->dropColumn(['discount','promo_code_id']);
        });

        
        Schema::table('receipts', function (Blueprint $table) {
           $table->dropForeign(['promo_code_id']);
           $table->dropColumn(['discount','promo_code_id']);
        });
    }
};
