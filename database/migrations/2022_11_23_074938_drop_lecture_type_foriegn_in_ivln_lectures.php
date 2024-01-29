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
        Schema::table('ivln_lectures', function (Blueprint $table) {
            $table->dropForeign(['lecture_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivln_lectures', function (Blueprint $table) {
            $table->foreign('lecture_type_id')->references('id')->on('ivln_lectures_types')->onUpdate('set null')->onDelete('set null');
        });
    }
};
