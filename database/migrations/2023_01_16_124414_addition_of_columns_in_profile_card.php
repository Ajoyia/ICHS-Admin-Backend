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
        Schema::table('profile_cards', function (Blueprint $table) {
            $table->bigInteger('country_id')->unsigned()->nullable()->default(null)->after('category_id');
            $table->string('designation')->after('country_id')->nullable();
            $table->string('job_title')->after('designation')->nullable();
            $table->string('credentails')->after('job_title')->nullable();

            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_cards', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('designation');
            $table->dropColumn('job_title');
            $table->dropColumn('credentails');
        });
    }
};
