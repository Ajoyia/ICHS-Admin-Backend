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
        Schema::create('membership_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->text('brief_overview')->nullable()->default(null);
            $table->string('headquarter_address')->nullable()->default(null);
            $table->string('organization_website')->nullable()->default(null);
            $table->string('branch_address')->nullable()->default(null);

            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('headquarter_country_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('branch_country_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('headquarter_city_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('headquarter_state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('membership_id')->unsigned()->nullable()->default(null);

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('headquarter_city_id')->references('id')->on('cities')->onUpdate('set null')->onDelete('set null');
            $table->foreign('headquarter_state_id')->references('id')->on('states')->onUpdate('set null')->onDelete('set null');
            $table->foreign('headquarter_country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
            $table->foreign('branch_country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
            $table->foreign('membership_id')->references('id')->on('memberships')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('membership_organizations');
    }
};
