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
        Schema::create('accredation_activity_administrators', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('accredation_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('salutation_id')->unsigned()->nullable()->default(null);
            $table->string('first_name')->default(null)->nullable()->index();
            $table->string('last_name')->default(null)->nullable()->index();
            $table->string('email')->nullable();
            $table->string('organization')->default(null)->nullable()->index();
            $table->string('mobile_no', 20)->default(null)->nullable()->index();
            $table->string('address')->default(null)->nullable();
            $table->tinyInteger('is_approved')->comment('0 => pending, 1 => accept, 2 => reject')->default(0);
            $table->boolean('is_policy_agreement_email_sent')->default(false)->nullable();
            $table->dateTime('policy_agreement_email_sent_date')->default(null)->nullable();
            $table->string('role_other')->nullable();
            $table->boolean('is_policy_agreement_signed')->default(false)->nullable();
            $table->dateTime('policy_agreement_signed_date')->default(null)->nullable();
      
            
            $table->bigInteger('city_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);
            
            
            $table->bigInteger('role_id')->unsigned()->nullable()->default(null);
            /* user information */
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('accredation_id')->references('id')->on('accredation_applications')->onUpdate('set null')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('accredation_roles')->onDelete('set null');
            $table->foreign('salutation_id')->references('id')->on('salutations')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accredation_activity_administrators');
    }
};
