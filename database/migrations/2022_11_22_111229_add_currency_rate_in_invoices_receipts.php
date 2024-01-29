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
            $table->double('currency_rate')->after('total_amount')->default(0)->nullable();
        });
        Schema::table('receipts', function (Blueprint $table) {
            $table->double('currency_rate')->after('total_amount')->default(0)->nullable();
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
             $table->dropColumn(['currency_rate']);
        });
        Schema::table('receipts', function (Blueprint $table) {
             $table->dropColumn(['currency_rate']);
        });
    }
};
