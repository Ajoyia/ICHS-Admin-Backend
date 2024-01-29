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
        Schema::table('grants', function (Blueprint $table) {
            $table->text('organization_vision')->nullable()->change();
            $table->text('organization_history')->nullable()->change();
            $table->text('outline_current_activities')->nullable()->change();
            $table->text('accomplishments')->nullable()->change();
            $table->text('activity_goals')->nullable()->change();
            $table->text('executive_summary')->nullable()->change();
            $table->text('benefiting_area')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grants', function (Blueprint $table) {
            $table->string('organization_vision')->nullable()->change();
            $table->string('organization_history')->nullable()->change();
            $table->string('outline_current_activities')->nullable()->change();
            $table->string('accomplishments')->nullable()->change();
            $table->string('activity_goals')->nullable()->change();
            $table->string('executive_summary')->nullable()->change();
            $table->string('benefiting_area')->nullable()->change();
        });
    }
};
