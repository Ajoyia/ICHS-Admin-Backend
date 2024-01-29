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
        Schema::create('auto_payment_card_logs', function (Blueprint $table) {
            $table->id();
            $table->string('state')->default(null)->nullable();
            $table->string('reference')->default(null)->nullable();
            $table->string('frequency')->default(null)->nullable();
            $table->string('order_reference')->default(null)->nullable();
            $table->string('outlet_id')->default(null)->nullable();
            $table->string('start_time')->default(null)->nullable();
            $table->string('next_payment_on')->default(null)->nullable();
            $table->json('response')->default(null)->nullable();
            $table->bigInteger('card_id')->unsigned()->nullable()->default(null);
            $table->morphs('model','model');
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
        Schema::dropIfExists('auto_payment_card_logs');
    }
};