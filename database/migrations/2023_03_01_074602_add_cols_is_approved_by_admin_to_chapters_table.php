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
        Schema::table('chapters', function (Blueprint $table) {
            //
            $table->tinyInteger('is_approved_by_admin')->after('id')->default(0)->nullable()->comment('0 => pending, 1 => accept, 2 => reject');
            $table->bigInteger('user_id')->unsigned()->after('id')->nullable()->default(null);
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
        Schema::table('chapters', function (Blueprint $table) {
            //
            $table->dropForeign('chapters_user_id_foreign');
            $table->dropColumn(['user_id', 'is_approved_by_admin']);
        });
    }
};
