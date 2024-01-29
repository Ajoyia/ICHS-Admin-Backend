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
        Schema::create('tag_key_words', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->nullable()->default(null);
            $table->bigInteger('page_id')->unsigned()->nullable();
            $table->string('title')->nullable()->default(null);
            $table->text('keywords')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->bigInteger('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');

            $table->foreign('page_id')->references('id')->on('static_pages')->onUpdate('set null')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_key_words');
    }
};
