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
        Schema::table('grants', function (Blueprint $table) {
            $table->bigInteger('grant_purpose_id')->unsigned()->nullable();
            $table->foreign('grant_purpose_id')->references('id')->on('grant_purposes')->onUpdate('set null')->onDelete('set null')->after('chapter_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grants', function (Blueprint $table) {
            $table->dropColumn('grant_purpose_id');
        });
    }
};
