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
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            $table->dropForeign('cme_activity_administrators_salutation_id_foreign');
            $table->foreign('salutation_id')->references('id')->on('salutations')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('cme_activity_administrators', function (Blueprint $table) {
        //     $table->foreign('salutation_id')->references('id')->on('cme_roles')->onUpdate('set null')->onDelete('set null');
        // });
    }
};
