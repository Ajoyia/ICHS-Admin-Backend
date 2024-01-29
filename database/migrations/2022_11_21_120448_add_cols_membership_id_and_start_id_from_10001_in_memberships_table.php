<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships', function (Blueprint $table) {
            //
            $table->string('membership_id')->after('id')->nullable();
        });
        DB::statement('ALTER TABLE memberships AUTO_INCREMENT = 10001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE memberships AUTO_INCREMENT = 1;');
        Schema::table('memberships', function (Blueprint $table) {
            //
            $table->dropColumn('membership_id');

        });
    }
};
