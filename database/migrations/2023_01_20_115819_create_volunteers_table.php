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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('region_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('chapter_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('volunteer_type_id')->unsigned()->nullable()->default(null);
            $table->string('volunteer_type_other')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->tinyInteger('status')->default(true);
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('set null')->onDelete('set null');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onUpdate('set null')->onDelete('set null');
            $table->foreign('volunteer_type_id')->references('id')->on('volunteer_types')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('volunteers');
    }
};
