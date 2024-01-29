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
        Schema::table('cme_speakers', function (Blueprint $table) {
            //
            $table->string('designation')->nullable()->after('bio');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_speakers', function (Blueprint $table) {
            //
            $table->dropColumn('designation');
        });
    }
};