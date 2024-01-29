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
      
            Schema::table('remarks', function (Blueprint $table) {
                $table->bigInteger('user_id')->unsigned()->nullable()->default(null)->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remarks', function (Blueprint $table) {
            //
            $table->dropForeign('remarks_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
