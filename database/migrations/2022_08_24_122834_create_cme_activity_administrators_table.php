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
        Schema::create('cme_activity_administrators', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('salutation_id')->unsigned()->nullable()->default(null);
            $table->string('first_name')->default(null)->nullable()->index();
            $table->string('last_name')->default(null)->nullable()->index();
            $table->string('email')->unique()->index();
            $table->string('organization')->default(null)->nullable()->index();
            $table->string('mobile_no',20)->default(null)->nullable()->index();
            $table->string('address')->default(null)->nullable();

            $table->bigInteger('city_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);


            $table->string('pin_code',20)->default(null)->nullable();
            $table->bigInteger('role_id')->unsigned()->nullable()->default(null);
            /* user information */
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('cme_roles')->onDelete('set null');
            $table->foreign('salutation_id')->references('id')->on('cme_roles')->onDelete('set null');
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
        Schema::dropIfExists('cme_activity_administrators');
    }
};