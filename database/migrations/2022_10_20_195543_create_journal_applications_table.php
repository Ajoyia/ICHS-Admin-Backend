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
        Schema::create('journal_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('form_type_id')->unsigned()->nullable()->default(null);
            $table->string('keywords')->nullable()->default(null);
            $table->string('file_path')->nullable()->default(null);
            $table->integer('total_no_pages')->nullable()->default(null); 
            $table->double('price')->nullable()->default(null);
            $table->bigInteger('is_research_faculty_approved')->unsigned()->nullable()->default(null);
            $table->bigInteger('is_approved_london_office')->unsigned()->nullable()->default(null);
            $table->string('final_submisssion')->nullable()->default(null);

            $table->bigInteger('final_approved_london_office')->unsigned()->nullable()->default(null);


            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('form_type_id')->references('id')->on('journal_form_types')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('journal_applications');
    }
};
