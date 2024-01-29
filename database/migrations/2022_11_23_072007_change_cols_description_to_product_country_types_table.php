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
        Schema::table('product_country_type', function (Blueprint $table) {
            //
            // $table->text('description')->change();
            // $table->longText('benefits')->change();

            $table->text('benefits')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_country_type', function (Blueprint $table) {
            //
            $table->dropColumn('benefits')->change();

        });
    }
};
