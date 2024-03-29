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
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            $table->string('experience')->nullable()->after('organization');
            $table->string('designation')->nullable()->after('organization');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            $table->dropColumn(['designation','experience']);
        });
    }
};
