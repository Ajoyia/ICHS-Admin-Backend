<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('health_innovation_initiatives', function (Blueprint $table) {
            $table->string('hii_unique_id')->after('id')->nullable();
        });

        DB::statement('ALTER TABLE health_innovation_initiatives AUTO_INCREMENT = 10001;');


        Schema::table('journal_applications', function (Blueprint $table) {
            $table->string('jichs_unique_id')->after('id')->nullable();;
        });

        DB::statement('ALTER TABLE journal_applications AUTO_INCREMENT = 10001;');

        Schema::table('cme_applications', function (Blueprint $table) {
            $table->string('cme_unique_id')->after('id')->nullable();;
        });

        DB::statement('ALTER TABLE cme_applications AUTO_INCREMENT = 10001;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_innovation_initiatives', function (Blueprint $table) {
            //
            $table->dropColumn('hii_unique_id');
        });

        DB::statement('ALTER TABLE health_innovation_initiatives AUTO_INCREMENT = 1;');
       

        Schema::table('journal_applications', function (Blueprint $table) {
            //
            $table->dropColumn('jichs_unique_id');

        });

        DB::statement('ALTER TABLE journal_applications AUTO_INCREMENT = 1;');
       

        Schema::table('cme_applications', function (Blueprint $table) {
            //
            $table->dropColumn('cme_unique_id');
        });

        DB::statement('ALTER TABLE cme_applications AUTO_INCREMENT = 1;');
       
    }
};
