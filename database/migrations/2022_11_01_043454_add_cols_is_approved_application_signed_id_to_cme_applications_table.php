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
            $table->tinyInteger('is_approved')->comment('0 => pending, 1 => accept, 2 => reject')->after('mobile_no')->default(0);
            $table->bigInteger('application_signed_id')->unsigned()->nullable()->default(null)->after('salutation_id');

            $table->foreign('application_signed_id')->references('id')->on('application_signatures')->onUpdate('set null')->onDelete('set null');
            
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
            $table->dropForeign('cme_applications_application_signed_id_foreign');
            $table->dropColumn('application_signed_id');
            $table->dropColumn('is_approved');
        });
    }
};
