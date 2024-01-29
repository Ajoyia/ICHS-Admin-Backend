<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accredation_applications', function (Blueprint $table) {
            $table->id();

            $table->string('accredation_unique_id')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);

            $table->bigInteger('accredation_product_id')->unsigned()->nullable()->default(null);
            $table->tinyInteger('status_id')->comment('submitted => 1,approved=> 2,rejected=> 3,draft=> 4,under_review=> 5,in_progress=> 6,completed=>7')->default(6);
            $table->enum('is_approved_by_london_office', ['approve', 'reject'])->nullable();
            $table->bigInteger('london_office_id')->unsigned()->nullable()->default(null);


            $table->tinyInteger('is_approved')->comment('0 => pending, 1 => accept, 2 => reject')->default(0);
            $table->bigInteger('accredation_signed_id')->unsigned()->nullable()->default(null);
            $table->enum('is_approved_by_congress_commissioner', ['approve', 'reject'])->nullable();
            $table->bigInteger('congress_commissioner_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('credit_hours')->unsigned()->nullable()->default(null);
            $table->tinyInteger('total_credits')->nullable();
            $table->string('learning_format_others')->nullable();
            $table->string('social_event_others')->nullable();
            $table->tinyInteger('draft_stage')->nullable();

            $table->string('activity_type_others')->nullable();
            $table->string('activity_evaluation_method_other')->nullable()->default(null);
            $table->string('activity_evaluation_method')->nullable()->default(null);
            $table->string('first_name')->default(null)->nullable()->index();
            $table->string('last_name')->default(null)->nullable()->index();
            $table->string('email')->nullable();
            $table->string('organization')->default(null)->nullable()->index();
            $table->string('mobile_no', 20)->default(null)->nullable()->index();
            $table->string('address')->default(null)->nullable();

            $table->bigInteger('city_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);

            $table->string('cme_activity', 600)->default(null)->nullable();
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

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('set null')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('set null')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
            $table->foreign('accredation_product_id')->references('id')->on('accredation_products')->onUpdate('set null')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('accredation_signed_id')->references('id')->on('accredation_signatures')->onUpdate('set null')->onDelete('set null');
            $table->foreign('congress_commissioner_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('london_office_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');

            $table->foreign('created_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
        });

        DB::statement('ALTER TABLE accredation_applications AUTO_INCREMENT = 10001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accredation_applications');
    }
};
