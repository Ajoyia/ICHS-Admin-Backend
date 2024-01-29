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
            $table->enum('is_approved_by_london_office', ['approve', 'reject'])->nullable()->after('is_approved');
            $table->bigInteger('london_office_id')->unsigned()->nullable()->default(null)->after('is_approved');

            $table->foreign('london_office_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
       
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
            $table->dropForeign('cme_applications_london_office_id_foreign');
            $table->dropColumn('london_office_id');
            $table->dropColumn('is_approved_by_london_office');
        });
    }
};
