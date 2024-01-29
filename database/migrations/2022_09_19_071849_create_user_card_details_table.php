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
        Schema::create('user_card_details', function (Blueprint $table) {
            $table->id();
            $table->string('expiry')->default(null)->nullable();
            $table->string('card_holder_name')->default(null)->nullable();
            $table->string('scheme')->default(null)->nullable();
            $table->string('masked_pan',16)->default(null)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->morphs('model','model');
            $table->string('card_token')->default(null)->nullable();
            $table->string('recapture_csc')->default(null)->nullable();

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            
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
        Schema::dropIfExists('user_card_details');
    }
};