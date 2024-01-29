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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_job_title_id_foreign');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('job_title_id')->nullable()->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('job_title_id', 'job_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn( 'job_title', 'job_title_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('job_title_id')->unsigned()->nullable()->default(null)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('job_title_id')->references('id')->on('jobs_titles')->onUpdate('set null')->onDelete('set null');
        });
    }
};
