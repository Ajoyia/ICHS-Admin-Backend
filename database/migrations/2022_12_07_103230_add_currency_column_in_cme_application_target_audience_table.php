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
        Schema::table('cme_application_target_audience', function (Blueprint $table) {
            $table->bigInteger('currency_id')->unsigned()->nullable()->after('cme_application_id');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_application_target_audience', function (Blueprint $table) {
            //
        });
    }
};
