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
            //
            $table->string('type_others')->after('total_learners')->nullable();
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
            $table->dropColumn('type_others');
        });
    }
};
