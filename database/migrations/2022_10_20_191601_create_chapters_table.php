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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('city_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('state_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null);

            $table->string('detail',500)->nullable()->default(null);
            $table->string('petition_no',500)->index()->nullable()->default(null);

            $table->bigInteger('is_approved')->unsigned()->nullable()->default(null);
            $table->bigInteger('is_approved_commissioner')->unsigned()->nullable()->default(null);
            $table->bigInteger('is_approved_board_member')->unsigned()->nullable()->default(null);


            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->bigInteger('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
};
