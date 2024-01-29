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
        Schema::table('volunteers', function (Blueprint $table) {
            //
            $table->bigInteger('policy_id')->unsigned()->nullable()->default(null)->after('id');
            $table->foreign('policy_id')->references('id')->on('policies')->onUpdate('set null')->onDelete('set null');
            $table->boolean('is_approved')->default(false)->nullable()->after('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteers', function (Blueprint $table) {
            //
            $table->dropForeign(['policy_id']);
            $table->dropColumn(['policy_id', 'is_approved']);
        });
    }
};
