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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('product_id')->unsigned()->nullable()->default(null);
            $table->morphs('model','model');
            $table->boolean('status')->default(true)->nullable();
            $table->json('data')->default(null)->nullable();

            $table->string('link')->default(null)->nullable();

            $table->double('total_amount')->default(0)->nullable();
            $table->double('net_amount')->default(0)->nullable();
            $table->double('vat')->default(0)->nullable();
            $table->string('currency')->default(null)->nullable();    

            $table->bigInteger('invoice_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('set null')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('product_country_type')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('receipts');
    }
};