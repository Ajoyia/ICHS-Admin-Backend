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
        Schema::create('ivln_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('overview')->default(null)->nullable();
            $table->longText('content')->nullable();
            $table->string('file_path')->default(null)->nullable();
            $table->float('total_minuts')->default(null)->nullable();

            $table->bigInteger('section_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('course_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('lecture_type_id')->unsigned()->nullable()->default(null);

            $table->boolean('status')->default(true)->nullable();

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('section_id')->references('id')->on('ivln_sections')->onUpdate('set null')->onDelete('set null');
            $table->foreign('lecture_type_id')->references('id')->on('ivln_lectures_types')->onUpdate('set null')->onDelete('set null');
            $table->foreign('course_id')->references('id')->on('ivln_courses')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('ivln_lectures');
    }
};
