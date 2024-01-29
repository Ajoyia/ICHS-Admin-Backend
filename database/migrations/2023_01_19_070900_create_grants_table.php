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
        Schema::create('grants', function (Blueprint $table) {
            $table->id();
            $table->string('executive_director_name')->nullable();
            $table->string('executive_director_phone_no')->nullable();
            $table->string('executive_director_email')->nullable();

            $table->string('program_director_name')->nullable();
            $table->string('program_director_phone_no')->nullable();
            $table->string('program_director_email')->nullable();

            $table->string('organization')->nullable();
            $table->date('year_founded')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('city_id')->unsigned()->nullable()->default(null);
            $table->string('zip_code')->nullable();
            $table->string('organization_vision')->nullable();
            $table->string('organization_history')->nullable();
            $table->string('outline_current_activities')->nullable();
            $table->string('accomplishments')->nullable();
            $table->string('activity')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('activity_goals')->nullable();
            $table->string('executive_summary')->nullable();
            $table->bigInteger('chapter_id')->unsigned()->nullable();
            $table->integer('beneficiaries_number')->nullable();
            $table->string('specialities')->nullable();
            $table->string('benefiting_area')->nullable();
            $table->integer('expenses_amount')->nullable();
            $table->integer('revenue_amount')->nullable();
            $table->integer('requested_amount')->nullable();
            $table->string('expenses_file_path')->nullable();
            $table->string('revenues_file_path')->nullable();
            $table->string('grant_expenses_file_path')->nullable();
            $table->string('initials_director')->nullable();
            $table->string('initials_executive_director')->nullable();
            $table->boolean('agreement_accepted')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->tinyInteger('status')->default(true);
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('set null')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('set null')->onDelete('set null');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onUpdate('set null')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('grants');
    }
};
