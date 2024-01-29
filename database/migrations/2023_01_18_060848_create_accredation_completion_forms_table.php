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
        Schema::create('accredation_completion_forms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('acc_id')->unsigned()->nullable()->default(null);
            $table->tinyInteger('is_completed')->comment('1=>completed, 0=> pending')->default(0);

            $table->integer('credit_hour')->nullable();
            $table->string('pdf_path')->nullable();

            $table->string('cme_validation')->nullable();
            $table->string('commercial_independence')->nullable();
            $table->string('evaluation_summary')->nullable();
            $table->string('commercial_support')->nullable();

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('accredation_completion_forms');
    }
};
