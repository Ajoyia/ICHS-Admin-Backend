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
        Schema::table('cme_applications', function (Blueprint $table) {
            $table->tinyInteger('statuses_id')->comment('submitted => 1,approved=> 2,rejected=> 3,draft=> 4,under_review=> 5,in_progress=> 6,completed=>7')->after('user_id')->default(6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_applications', function (Blueprint $table) {
            //
            $table->dropColumn('statuses_id');
           
        });
    }
};
