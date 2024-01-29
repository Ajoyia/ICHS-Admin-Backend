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
        Schema::table('journal_applications', function (Blueprint $table) {
            //
            $table->integer('no_of_reviews_requested')->nullable()->default(0)->after('is_approved_london_office');
            $table->integer('no_of_pages')->nullable()->after('no_of_reviews_requested');
            $table->dateTime('review_requested_time')->nullable()->after('no_of_pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journal_applications', function (Blueprint $table) {
            //
            $table->dropColumn(['no_of_reviews_requested', 'no_of_pages', 'review_requested_time']);
        });
    }
};
