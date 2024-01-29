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
            $table->string('other_specialty')->after('image')->nullable();
        });
        Schema::table('grants', function (Blueprint $table) {
            $table->string('other_specialty')->after('executive_summary')->nullable();
        });
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            $table->string('other_specialty')->after('designation')->nullable();
        });
        Schema::table('accredation_activity_administrators', function (Blueprint $table) {
            $table->string('other_specialty')->after('organization')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('other_specialty');
        });
        Schema::table('grants', function (Blueprint $table) {
            $table->dropColumn('other_specialty');
        });
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            $table->dropColumn('other_specialty');
        });
        Schema::table('accredation_activity_administrators', function (Blueprint $table) {
            $table->dropColumn('other_specialty');
        });
    }
};
