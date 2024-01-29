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
        Schema::create('cme_application_target_audience', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('audience_type')->unsigned()->nullable()->default(null);
            
            $table->bigInteger('total_learners')->default(null)->nullable();
            $table->bigInteger('role_id')->unsigned()->nullable()->default(null);
            $table->boolean('is_fee')->default(true)->nullable();
            $table->double('fee')->default(null)->nullable();
            /* user information */
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('audience_type')->references('id')->on('cme_target_audience')->onUpdate('set null')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('cme_roles')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('cme_application_target_audience');
    }
};