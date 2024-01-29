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
        Schema::table('policies', function (Blueprint $table) {
            //
            $table->boolean('is_volunteer')->after('slug')->default(false);
            $table->integer('hours')->nullable()->after('is_volunteer');
            $table->text('description')->nullable()->after('hours');
            $table->json('time_breakup')->nullable()->default(null)->after('description');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policies', function (Blueprint $table) {
            //
            $table->dropColumn(['is_volunteer', 'hours', 'description', 'time_breakup']);
        });
    }
};
