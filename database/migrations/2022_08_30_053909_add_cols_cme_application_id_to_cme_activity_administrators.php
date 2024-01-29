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
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            //
            $table->bigInteger('cme_application_id')->unsigned()->nullable()->default(null)->after('salutation_id');
            $table->foreign('cme_application_id')->references('id')->on('cme_applications')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            //

            $table->dropForeign('cme_activity_administrators_cme_application_id_foreign');
            $table->dropColumn('cme_application_id');

        });
    }
};
