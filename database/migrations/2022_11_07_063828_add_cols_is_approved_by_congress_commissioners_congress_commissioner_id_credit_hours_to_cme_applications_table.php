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
            $table->enum('is_approved_by_congress_commissioner', ['approve', 'reject'])->nullable()->after('is_approved');
            $table->bigInteger('congress_commissioner_id')->unsigned()->nullable()->default(null)->after('is_approved');
            $table->bigInteger('credit_hours')->unsigned()->nullable()->default(null)->after('is_approved');

            $table->foreign('congress_commissioner_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
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
            $table->dropForeign('cme_applications_congress_commissioner_id_foreign');
            $table->dropColumn('congress_commissioner_id');
            $table->dropColumn('is_approved_by_congress_commissioner');
            $table->dropColumn('credit_hours');
        });
    }
};
