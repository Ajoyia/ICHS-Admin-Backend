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
         Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('product_id')->unsigned()->nullable()->default(null);
            $table->morphs('model','model');
            $table->string('method')->default(null)->nullable();
            $table->string('card_no')->default(null)->nullable();
            $table->text('note')->default(null)->nullable();
            $table->integer('payment_status')->default(null)->nullable();
            $table->string('payment_ref')->default(null)->nullable();
            
            $table->boolean('status')->default(true)->nullable();
            
            $table->bigInteger('invoice_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('receipt_id')->unsigned()->nullable()->default(null);
            
            $table->double('total_amount')->nullable()->default(null);
            
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('product_country_type')->onUpdate('set null')->onDelete('set null');


            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('set null')->onDelete('set null');
            $table->foreign('receipt_id')->references('id')->on('receipts')->onUpdate('set null')->onDelete('set null');
            
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
        Schema::dropIfExists('transaction_details');
    }
};