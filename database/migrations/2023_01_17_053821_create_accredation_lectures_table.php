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
        Schema::create('accredation_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(null)->nullable();
            $table->string('heading')->default(null)->nullable();
            $table->boolean('featured')->default(true)->nullable();
            $table->text('description')->nullable()->default(null);
            $table->timestamp('starttime')->default(null)->nullable();
            $table->timestamp('endtime')->default(null)->nullable();
            $table->boolean('break')->default(false)->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->bigInteger('session_location_id')->unsigned()->nullable()->default(null);
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('acc_session_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('acc_id')->unsigned()->nullable()->default(null);
            $table->string('learning_objectives')->nullable();
            $table->string('special_accommodations')->nullable();
            $table->string('break_time')->nullable();
            $table->string('audio_visual_type')->nullable();
            $table->string('audio_visual_other')->nullable();
            $table->string('interactive_technology_other')->nullable();
            $table->string('presentation_format_other')->nullable();
            $table->bigInteger('audio_visual_id')->unsigned()->nullable();
            $table->bigInteger('interactive_technology_id')->unsigned()->nullable();
            $table->bigInteger('presentation_format_id')->unsigned()->nullable();

            
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('audio_visual_id')->references('id')->on('accredation_lecture_audio_visuals')->onUpdate('set null')->onDelete('set null');
            $table->foreign('interactive_technology_id')->references('id')->on('accredation_interactive_technologies')->onUpdate('set null')->onDelete('set null');
            $table->foreign('presentation_format_id')->references('id')->on('accredation_presentation_formats')->onUpdate('set null')->onDelete('set null');
            $table->foreign('acc_session_id')->references('id')->on('accredation_sessions')->onUpdate('set null')->onDelete('set null');
            $table->foreign('session_location_id')->references('id')->on('accredation_locations')->onUpdate('set null')->onDelete('set null');
            $table->foreign('acc_id')->references('id')->on('accredation_applications')->onUpdate('set null')->onDelete('set null');


            $table->foreign('created_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accredation_lectures');
    }
};
