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
            $table->enum('type', ['yearly', 'monthly', 'expired_on'])->default('yearly')->nullable()->after('is_published');
            $table->integer('validity')->default(1)->nullable()->after('type');
            $table->date('expire_on')->default(null)->nullable()->after('validity');
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
           $table->dropColumn(['type','validity','expire_on']);
        });
    }
};