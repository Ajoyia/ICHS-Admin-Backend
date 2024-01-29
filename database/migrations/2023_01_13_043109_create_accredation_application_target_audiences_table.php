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
        Schema::create('acc_target_audiences', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('audience_type')->unsigned()->nullable()->default(null);
            $table->bigInteger('acc_application_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('currency_id')->unsigned()->nullable();
            
            $table->bigInteger('total_learners')->default(null)->nullable();
            $table->bigInteger('role_id')->unsigned()->nullable()->default(null);
            $table->boolean('is_fee')->default(true)->nullable();
            $table->double('fee')->default(null)->nullable();
            $table->string('type_others')->nullable();
            $table->string('specialty_other')->nullable()->default(null);

            /* user information */
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('audience_type')->references('id')->on('accredation_target_audiences')->onUpdate('set null')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('accredation_roles')->onUpdate('set null')->onDelete('set null');
            $table->foreign('acc_application_id')->references('id')->on('accredation_applications')->onUpdate('set null')->onDelete('set null');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('set null')->onDelete('set null');
            
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
        Schema::dropIfExists('acc_target_audiences');
    }
};
