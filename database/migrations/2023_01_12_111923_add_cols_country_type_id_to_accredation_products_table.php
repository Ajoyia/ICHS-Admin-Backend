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
        Schema::table('accredation_products', function (Blueprint $table) {
            //
            $table->bigInteger('country_type_id')->unsigned()->nullable()->default(null);
            $table->foreign('country_type_id')->references('id')->on('countries_type')->onUpdate('set null')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accredation_products', function (Blueprint $table) {
            //
            $table->dropForeign(['country_type_id']);
            $table->dropColumn('country_type_id');
      
        });
    }
};
