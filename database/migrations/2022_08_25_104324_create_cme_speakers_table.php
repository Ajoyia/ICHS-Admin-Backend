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
        Schema::create('cme_speakers', function (Blueprint $table) {
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
            $table->text('image')->default(null)->nullable();
            $table->boolean('feature')->default(true)->nullable();
            $table->boolean('is_publish')->default(true)->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('cme_application_id')->unsigned()->nullable()->default(null);

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null); 
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign('salutation_id')->references('id')->on('salutations')->onUpdate('set null')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
            $table->foreign('cme_application_id')->references('id')->on('cme_applications')->onUpdate('set null')->onDelete('set null');
            
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
        Schema::dropIfExists('cme_speakers');
    }
};