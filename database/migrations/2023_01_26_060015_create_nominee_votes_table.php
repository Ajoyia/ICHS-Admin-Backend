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
        Schema::create('nominee_votes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('award_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('nominee_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('voted_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('award_id')->references('id')->on('awards')->onUpdate('set null')->onDelete('set null');
            $table->foreign('nominee_id')->references('id')->on('award_nominees')->onUpdate('set null')->onDelete('set null');
            $table->foreign('voted_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('nominee_votes');
    }
};
