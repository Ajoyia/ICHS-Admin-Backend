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
        Schema::table('cme_completion_forms', function (Blueprint $table) {
            //
            $table->string('pdf_path')->nullable()->after('credit_hour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_completion_forms', function (Blueprint $table) {
            //
            $table->dropColumn('pdf_path');
        });
    }
};
