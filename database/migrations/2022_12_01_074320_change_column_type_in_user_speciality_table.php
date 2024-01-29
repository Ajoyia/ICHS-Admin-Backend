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
        Schema::table('user_specialties', function (Blueprint $table) {
            $table->dropForeign('user_specialties_speciality_id_foreign');
        });
        Schema::table('user_specialties', function (Blueprint $table) {
            $table->string('speciality_id', 256)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_specialties', function (Blueprint $table) {
            $table->bigInteger('speciality_id')->unsigned()->nullable()->default(null)->change();
            $table->foreign('speciality_id')->references('id')->on('specialties')->onUpdate('set null')->onDelete('set null');
        });
    }
};
