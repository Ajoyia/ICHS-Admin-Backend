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
        Schema::create('cme_applications', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('salutation_id')->unsigned()->nullable()->default(null);
            
            $table->string('first_name')->default(null)->nullable()->index();
            $table->string('last_name')->default(null)->nullable()->index();
            $table->string('email')->unique()->index();
            $table->string('organization')->default(null)->nullable()->index();
            $table->string('mobile_no',20)->default(null)->nullable()->index();
            $table->string('address')->default(null)->nullable();
            $table->string('pin_code',20)->default(null)->nullable();

            $table->bigInteger('city_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);

            $table->string('cme_activity',600)->default(null)->nullable();
            /* user information */
            $table->string('title_event')->default(null)->nullable();
            $table->string('frequency')->default(null)->nullable();
            $table->dateTime('event_date')->default(null)->nullable();
            
            $table->string('educational_health_professionals')->default(null)->nullable();
            $table->string('evidence_based')->default(null)->nullable();
            
            $table->string('sales_biases')->default(null)->nullable();
            $table->string('initials_activity_director')->default(null)->nullable();
            $table->string('initials_activity_coordinatorvar')->default(null)->nullable();
            $table->string('activity_overview')->default(null)->nullable();

            $table->boolean('cme_cpd_provide')->default(true)->nullable();
            $table->boolean('cme_cpd_participants')->default(true)->nullable();

            $table->string('sessions_upload')->default(null)->nullable();


            $table->string('activity_evolution')->default(null)->nullable();

            $table->string('activity_evolution_other')->default(null)->nullable();
            

            
    
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

           
            $table->foreign('salutation_id')->references('id')->on('salutations')->onUpdate('set null')->onDelete('set null');    
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('set null')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('set null')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('cme_applications');
    }
};