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
        Schema::table('health_innovation_initiatives', function (Blueprint $table) {
            //
            $table->bigInteger('is_research_faculty_approved')->unsigned()->nullable()->default(null)->after('statuses_id');
            $table->bigInteger('is_approved_london_office')->unsigned()->nullable()->default(null)->after('is_research_faculty_approved');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_innovation_initiatives', function (Blueprint $table) {
            //
            $table->dropColumn(['is_research_faculty_approved', 'is_approved_london_office']);

        });
    }
};
