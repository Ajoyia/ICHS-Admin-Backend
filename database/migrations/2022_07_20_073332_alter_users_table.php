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
          $table->bigInteger('salutation_id')->unsigned()->nullable()->default(null)->after('id');
          $table->bigInteger('city_id')->unsigned()->nullable()->default(null)->after('address');
          $table->bigInteger('state_id')->unsigned()->nullable()->default(null)->after('city_id');
          $table->bigInteger('country_id')->unsigned()->nullable()->default(null)->after('state_id');
          $table->bigInteger('nationality_id')->unsigned()->nullable()->default(null)->after('country_id');
          $table->bigInteger('job_title_id')->unsigned()->nullable()->default(null)->after('nationality_id');


          $table->foreign('salutation_id')->references('id')->on('salutations')->onUpdate('set null')->onDelete('set null');
          $table->foreign('city_id')->references('id')->on('cities')->onUpdate('set null')->onDelete('set null');
          $table->foreign('state_id')->references('id')->on('states')->onUpdate('set null')->onDelete('set null');
          $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
          $table->foreign('nationality_id')->references('id')->on('nationalities')->onUpdate('set null')->onDelete('set null');
          $table->foreign('job_title_id')->references('id')->on('jobs_titles')->onUpdate('set null')->onDelete('set null');
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
            $table->dropForeign(['salutation_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['nationality_id']);
            $table->dropForeign(['job_title_id']);
            $table->dropColumn(['salutation_id','city_id','state_id','country_id','nationality_id','job_title_id']);
        });
    }
};
