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
        Schema::create('accredation_session_speakers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('acc_speakers_id')->unsigned()->nullable()->default(null);
            $table->morphs('model', 'model');
            $table->bigInteger('acc_id')->unsigned()->nullable()->default(null);

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('role_id')->references('id')->on('speaker_roles')->onUpdate('set null')->onDelete('set null');
      
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
        Schema::dropIfExists('accredation_session_speakers');
    }
};
