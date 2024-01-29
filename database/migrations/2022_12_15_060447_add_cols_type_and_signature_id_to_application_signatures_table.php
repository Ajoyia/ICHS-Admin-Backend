<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_signatures', function (Blueprint $table) {
            $table->string('signature_unique_id')->after('id')->nullable();
            $table->string('signature_type')->after('model_id')->nullable();
        });
        DB::statement('ALTER TABLE application_signatures AUTO_INCREMENT = 10001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE application_signatures AUTO_INCREMENT = 1;');
        Schema::table('application_signatures', function (Blueprint $table) {
            //
                $table->dropColumn(['signature_unique_id', 'signature_type']);
        });
    }
};
