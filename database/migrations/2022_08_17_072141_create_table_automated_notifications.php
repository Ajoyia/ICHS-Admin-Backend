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
        Schema::create('automated_notifications', function (Blueprint $table) {
            $table->id();

            $table->string('title')->default(null)->nullable();
            $table->string('subject')->default(null)->nullable();
            $table->text('message')->default(null)->nullable();
            $table->string('trigger_name')->default(null)->nullable();
            $table->boolean('send_admin')->nullable();
            $table->bigInteger('sender_id')->unsigned()->nullable()->default(null);

            $table->string('type')->default(null)->nullable();
            $table->json('admin_users')->default(null)->nullable();

            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('sender_id')->references('id')->on('notification_senders')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('automated_notifications');
    }
};