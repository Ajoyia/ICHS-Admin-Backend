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
        Schema::table('ivln_courses', function (Blueprint $table) {
            $table->boolean('featured')->after('thumbnail')->default(false);
            $table->bigInteger('speciality_id')->unsigned()->nullable()->default(null)->after('featured');
            $table->foreign('speciality_id')->references('id')->on('specialties')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivln_courses', function (Blueprint $table) {
            $table->dropColumn('featured');
            $table->dropColumn('speciality_id');
        });
    }
};
