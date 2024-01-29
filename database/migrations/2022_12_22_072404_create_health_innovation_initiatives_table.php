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
        Schema::create('health_innovation_initiatives', function (Blueprint $table) {
            $table->id();
            
            $table->string('title')->default(null)->nullable();
            $table->string('type_others')->default(null)->nullable();

            $table->text('keywords')->default(null)->nullable();
            $table->text('references')->default(null)->nullable();
            $table->text('backgrounds')->default(null)->nullable();
            $table->text('details')->default(null)->nullable();


            $table->text('declarations')->default(null)->nullable();
            $table->string('file_path')->default(null)->nullable();

            $table->boolean('status')->default(true)->nullable();

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
        Schema::dropIfExists('health_innovation_initiatives');
    }
};
