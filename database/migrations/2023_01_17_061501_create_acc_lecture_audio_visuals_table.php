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
        Schema::create('acc_lecture_audio_visuals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lecture_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('lav_id')->unsigned()->nullable()->default(null);
 

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lecture_id')->references('id')->on('accredation_lectures')->onUpdate('set null')->onDelete('set null');
            $table->foreign('lav_id')->references('id')->on('accredation_lecture_audio_visuals')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('acc_lecture_audio_visuals');
    }
};
