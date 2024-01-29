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
        Schema::create('accredation_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(null)->nullable();
            $table->string('heading')->default(null)->nullable();
            $table->boolean('featured')->default(true)->nullable();
            $table->text('description')->nullable()->default(null);
            $table->timestamp('starttime')->nullable();
            $table->timestamp('endtime')->nullable();
            $table->boolean('break')->default(false)->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->bigInteger('session_location_id')->unsigned()->nullable()->default(null);
            $table->boolean('status')->default(true)->nullable();

            $table->bigInteger('acc_id')->unsigned()->nullable()->default(null);

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('session_location_id')->references('id')->on('accredation_locations')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('accredation_sessions');
    }
};
