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
        Schema::table('users', function (Blueprint $table) {
            $table->string('university')->nullable()->default(null)->after('address');
            // $table->bigInteger('speciality_id')->unsigned()->nullable()->default(null)->after('university');
            // $table->foreign('speciality_id')->references('id')->on('specialties')->onUpdate('set null')->onDelete('set null');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('memberships', function (Blueprint $table) {
        //     //
        //     $table->dropForeign('memberships_speciality_id_foreign');
        //     $table->dropColumn('speciality_id');
        // });
    }
};
