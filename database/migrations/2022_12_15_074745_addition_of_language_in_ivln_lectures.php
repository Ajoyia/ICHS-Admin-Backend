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
            $table->bigInteger('language_id')->unsigned()->nullable()->default(null)->after('lecture_type_id');
            $table->foreign('language_id')->references('id')->on('languages')->onUpdate('set null')->onDelete('set null');
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
            $table->dropColumn('language_id');
        });
    }
};
