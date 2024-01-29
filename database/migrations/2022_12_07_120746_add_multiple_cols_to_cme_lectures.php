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
            $table->string('learning_objectives')->nullable()->after('description');
            $table->string('special_accommodations')->nullable()->after('description');
            
            $table->bigInteger('audio_visual_id')->unsigned()->nullable();
            $table->bigInteger('interactive_technology_id')->unsigned()->nullable();
            $table->bigInteger('presentation_format_id')->unsigned()->nullable();
            
            $table->foreign('audio_visual_id')->references('id')->on('cme_lecture_audio_visuals')->onUpdate('set null')->onDelete('set null');
            $table->foreign('interactive_technology_id')->references('id')->on('cme_lecture_interactive_technologies')->onUpdate('set null')->onDelete('set null');
            $table->foreign('presentation_format_id')->references('id')->on('cme_lecture_presentation_formats')->onUpdate('set null')->onDelete('set null');
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
            $table->dropForeign(['audio_visual_id']);
            $table->dropForeign(['interactive_technology_id']);
            $table->dropForeign(['presentation_format_id']);
            $table->dropColumn(['learning_objectives','special_accommodations','audio_visual_id','interactive_technology_id','presentation_format_id']);
        });
    }
};
