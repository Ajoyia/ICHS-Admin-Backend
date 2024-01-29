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
            $table->bigInteger('speciality_id')->unsigned()->nullable()->after('credentails')->default(null);
            $table->foreign('speciality_id')->references('id')->on('specialties')->onUpdate('set null')->onDelete('set null');
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
            $table->dropColumn('speciality_id');
        });
    }
};
