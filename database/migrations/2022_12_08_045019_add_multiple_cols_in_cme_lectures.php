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
        Schema::table('cme_lectures', function (Blueprint $table) {
            //
            $table->string('break_time')->nullable()->after('learning_objectives');
            $table->string('audio_visual_type')->nullable()->after('break_time');
            $table->string('audio_visual_other')->nullable()->after('audio_visual_type');
            $table->string('interactive_technology_other')->nullable()->after('audio_visual_other');
            $table->string('presentation_format_other')->nullable()->after('interactive_technology_other');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_lectures', function (Blueprint $table) {
            //
            $table->dropColumn(['break_time','audio_visual_type','audio_visual_other','interactive_technology_other','presentation_format_other']);

        });
    }
};
