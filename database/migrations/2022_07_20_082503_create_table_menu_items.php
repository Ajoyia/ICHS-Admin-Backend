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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(null)->nullable()->index();
            $table->string('link')->default(null)->nullable()->index();
            $table->string('icon')->default(null)->nullable()->index();
            $table->bigInteger('static_page_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('parent_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('type_id')->unsigned()->nullable()->default(null);            

            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('static_page_id')->references('id')->on('static_pages')->onUpdate('set null')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('menu_items')->onUpdate('set null')->onDelete('set null');
            $table->foreign('type_id')->references('id')->on('menu_types')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('menu_items');
    }
};