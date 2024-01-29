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
        Schema::create('hii_authors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hii_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('salutation_id')->unsigned()->nullable()->default(null);
            $table->string('first_name')->default(null)->nullable();
            $table->string('last_name')->default(null)->nullable();
            $table->string('credentials')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->string('phone_no')->default(null)->nullable();
            $table->string('job_title')->default(null)->nullable();
            $table->string('organization')->default(null)->nullable();
            $table->string('address')->default(null)->nullable();

            $table->bigInteger('nationality_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('city_id')->unsigned()->nullable()->default(null);

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('salutation_id')->references('id')->on('salutations')->onUpdate('set null')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('set null')->onDelete('set null');

            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('set null')->onDelete('set null');

            $table->foreign('nationality_id')->references('id')->on('nationalities')->onUpdate('set null')->onDelete('set null');

            $table->foreign('hii_id')->references('id')->on('health_innovation_initiatives')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('hii_authors');
    }
};
