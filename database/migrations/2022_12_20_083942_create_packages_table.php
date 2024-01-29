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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('tax_group_id')->unsigned()->nullable()->default(null);

            $table->string('description')->default(null)->nullable()->index();
            $table->double('price')->default(null)->nullable()->index();

            $table->integer('page_from')->default(null)->nullable()->index();

            $table->integer('page_to')->default(null)->nullable()->index();
            $table->boolean('status')->default(true)->nullable();

            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('set null')->onDelete('set null');
            $table->foreign('tax_group_id')->references('id')->on('tax_groups')->onUpdate('set null')->onDelete('set null');
            

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
        Schema::dropIfExists('packages');
    }
};
