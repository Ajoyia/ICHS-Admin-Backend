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
        Schema::create('accredation_speakers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->default(null)->nullable();
            $table->string('middle_name')->default(null)->nullable();
            $table->string('last_name')->default(null)->nullable();
            $table->bigInteger('salutation_id')->unsigned()->nullable()->default(null);
            $table->tinyInteger('order')->default(0)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->string('title')->default(null)->nullable();
            $table->string('entity')->default(null)->nullable();
            $table->text('bio')->default(null)->nullable();
            $table->string('designation')->nullable();
            $table->boolean('is_policy_agreement_email_sent')->default(false)->nullable();
            $table->dateTime('policy_agreement_email_sent_date')->default(null)->nullable();

            $table->boolean('is_policy_agreement_signed')->default(false)->nullable();
            $table->dateTime('policy_agreement_signed_date')->default(null)->nullable();
            $table->string('degree')->nullable();
            $table->string('phone_no')->nullable();
            $table->boolean('is_financial_relation_with_entity')->nullable();
            $table->string('company_name')->nullable();
            $table->string('relation_type')->nullable();
            $table->string('content_area')->nullable();
            $table->boolean('is_financial_relation_with_content')->nullable();
            $table->text('activity_planned')->nullable();

            $table->boolean('is_disclosure_email_sent')->default(false)->nullable();
            $table->dateTime('disclosure_email_sent_date')->default(null)->nullable();

            $table->boolean('is_disclosure_signed')->default(false)->nullable();
            $table->dateTime('disclosure_signed_date')->default(null)->nullable();


            $table->text('image')->default(null)->nullable();
            $table->boolean('feature')->default(true)->nullable();
            $table->boolean('is_publish')->default(true)->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('acc_id')->unsigned()->nullable()->default(null);
            $table->tinyInteger('is_approved')->comment('0 => pending, 1 => accept, 2 => reject')->default(0);
            $table->bigInteger('accredation_signed_id')->unsigned()->nullable()->default(null);
            
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            
            
            $table->foreign('accredation_signed_id')->references('id')->on('accredation_signatures')->onUpdate('set null')->onDelete('set null');
            $table->foreign('salutation_id')->references('id')->on('salutations')->onUpdate('set null')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('accredation_speakers');
    }
};
