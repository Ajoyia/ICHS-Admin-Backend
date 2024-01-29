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
            $table->string('degree_type')->nullable()->after('benefits');
            $table->double('percentage_required')->nullable()->after('degree_type');
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
            $table->dropColumn('degree_type');
            $table->dropColumn('percentage_required');
        });
    }
};
