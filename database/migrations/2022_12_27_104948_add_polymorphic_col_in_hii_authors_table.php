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
        Schema::table('hii_authors', function (Blueprint $table) {
            $table->string('authorable_type')->nullable()->after('id');
            $table->bigInteger('authorable_id')->unsigned()->nullable()->after('id');
        });
        Schema::table('hii_authors', function (Blueprint $table) {
            $table->dropForeign(['hii_id']);
            $table->dropColumn('hii_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hii_authors', function (Blueprint $table) {
            $table->dropColumn('authorable_id');
            $table->dropColumn('authorable_type');
        });
        Schema::table('hii_authors', function (Blueprint $table) {
            $table->bigInteger('hii_id')->unsigned()->nullable()->after('id');
        });
    }
};
