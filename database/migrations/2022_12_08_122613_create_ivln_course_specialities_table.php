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
        Schema::create('ivln_course_specialities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ivln_course_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('specialty_id')->unsigned()->nullable()->default(null);

            $table->foreign('ivln_course_id')->references('id')->on('ivln_courses')->onUpdate('set null')->onDelete('set null');
            $table->foreign('specialty_id')->references('id')->on('specialties')->onUpdate('set null')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ivln_course_specialities');
    }
};
