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
        //
        Schema::table('cme_session_speakers', function (Blueprint $table) {
            //
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
        Schema::table('cme_session_speakers', function (Blueprint $table) {
            //
            $table->dropForeign('cme_session_speakers_role_id_foreign');
          
        });
        //
    }
};
