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
        Schema::create('promotion_codes', function (Blueprint $table) {
            $table->id();
            $table->enum('promotion_type', ['percentage', 'fixed',"value"])->nullable();
            $table->text('value')->nullable();
            $table->text('promotion_code')->nullable();
            $table->integer('usage_limit');
            $table->integer('no_of_times_used')->default(0);
            $table->text('description')->nullable();
            $table->text('error_message_line1')->nullable();
            $table->text('error_message_line2')->nullable();
            $table->text('error_message_exceeded')->nullable();
            $table->text('approved_by')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->tinyInteger('status')->default(true);
            $table->dateTime('valid_from');
            $table->dateTime('valid_to');
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
        Schema::dropIfExists('promotion_codes');
    }
};
