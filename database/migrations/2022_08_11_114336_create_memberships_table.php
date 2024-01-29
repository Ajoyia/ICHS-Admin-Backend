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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('product_country_type_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('membership_type_id')->unsigned()->nullable()->default(null);

            $table->dateTime('start_date')->default(null)->nullable();
            $table->dateTime('end_date')->default(null)->nullable();
            $table->string('medical_facility')->nullable()->default(null);
            $table->string('medical_interests')->nullable()->default(null);

            $table->string('resume')->nullable()->default(null);
            

            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('product_country_type_id')->references('id')->on('product_country_type')->onUpdate('set null')->onDelete('set null');
            $table->foreign('membership_type_id')->references('id')->on('membership_types')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('memberships');
    }
};
