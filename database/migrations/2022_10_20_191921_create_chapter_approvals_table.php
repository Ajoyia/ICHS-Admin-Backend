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
        Schema::create('application_approvals', function (Blueprint $table) {
            $table->id();
            
            $table->morphs('model','model');
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->boolean('is_approved')->default(false)->nullable();
            $table->boolean('is_endorse')->default(true)->nullable();
            $table->bigInteger('is_approved_commissioner')->unsigned()->nullable()->default(null);
            $table->bigInteger('is_approved_board_member')->unsigned()->nullable()->default(null);
 

            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->bigInteger('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

           
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
        Schema::dropIfExists('application_approvals');
    }
};
