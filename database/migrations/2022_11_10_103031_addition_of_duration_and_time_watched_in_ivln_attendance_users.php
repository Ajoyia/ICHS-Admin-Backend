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
        Schema::table('ivln_attendance_users', function (Blueprint $table) {
            $table->double('duration')->nullable()->after('user_id');
            $table->double('time_watched')->nullable()->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivln_attendance_users', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('time_watched');
        });
    }
};