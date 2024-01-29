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
        Schema::create('user_policies_permissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('policy_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('permission_id')->unsigned()->nullable()->default(null);
                    

            $table->boolean('status')->default(true)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
            $table->bigInteger('deleted_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('permission_id')->references('id')->on('policies_permissions')->onUpdate('set null')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('policy_id')->references('id')->on('policies')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('user_policies_permissions');
    }
};