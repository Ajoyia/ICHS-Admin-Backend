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
        Schema::create('acc_lecture_interactive_technologies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lecture_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('lit_id')->unsigned()->nullable()->default(null);


            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lecture_id')->references('id')->on('accredation_lectures')->onUpdate('set null')->onDelete('set null');
            $table->foreign('lit_id')->references('id')->on('accredation_interactive_technologies')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('acc_lecture_interactive_technologies');
    }
};
