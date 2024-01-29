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
        Schema::table('ivln_speakers_lectures', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('speaker_roles')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivln_sperakers_lectures', function (Blueprint $table) {
            $table->dropIndex('ivln_speakers_lectures_role_id_foreign');
        });
    }
};
