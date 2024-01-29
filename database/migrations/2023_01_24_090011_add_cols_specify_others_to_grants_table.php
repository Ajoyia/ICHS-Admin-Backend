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
            //
            $table->string('educational_activity_type_other')->nullable();
            $table->string('specify_type_other')->nullable();
            
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
            //
            $table->dropColumn(['educational_activity_type_other', 'specify_type_other']);
        });
    }
};
