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
        Schema::create('user_specialties', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
        $table->bigInteger('speciality_id')->unsigned()->nullable()->default(null);
        

        $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
        $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
        $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
        
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
        $table->foreign('speciality_id')->references('id')->on('specialties')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('user_specialties');
    }
};