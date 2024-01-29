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
        Schema::table('journal_applications', function (Blueprint $table) {
            $table->boolean('featured')->after('final_approved_london_office')->default(false);
        });
        Schema::table('health_innovation_initiatives', function (Blueprint $table) {
            $table->boolean('featured')->after('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journal_applications', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
        Schema::table('health_innovation_initiatives', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
    }
};
