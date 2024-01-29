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
        Schema::create('notification_senders', function (Blueprint $table) {
            $table->id();
           

            $table->string('title')->default(null)->nullable();
            $table->string('host')->default(null)->nullable();
            $table->string('username')->default(null)->nullable();
            $table->string('password')->default(null)->nullable();
            $table->string('port')->default(null)->nullable();
            $table->string('from_email')->default(null)->nullable();
            $table->enum('type', ['smtp', 'infobip', 'elestic_email'])->default('smtp')->nullable();
            $table->string('account_key')->default(null)->nullable();
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
        Schema::dropIfExists('notification_senders');
    }
};
