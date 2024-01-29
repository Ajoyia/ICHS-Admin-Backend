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
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null)->after('salutation_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
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
            $table->dropForeign('cme_applications_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
