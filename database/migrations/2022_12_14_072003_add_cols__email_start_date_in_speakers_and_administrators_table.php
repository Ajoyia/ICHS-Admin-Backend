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
        Schema::table('cme_speakers', function (Blueprint $table) {
            //
            $table->boolean('is_policy_agreement_email_sent')->default(false)->nullable()->after('is_approved');
            $table->dateTime('policy_agreement_email_sent_date')->default(null)->nullable()->after('is_policy_agreement_email_sent');

            $table->boolean('is_policy_agreement_signed')->default(false)->nullable()->after('policy_agreement_email_sent_date');
            $table->dateTime('policy_agreement_signed_date')->default(null)->nullable()->after('is_policy_agreement_signed');
        });

        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            //
            $table->boolean('is_policy_agreement_email_sent')->default(false)->nullable()->after('is_approved');
            $table->dateTime('policy_agreement_email_sent_date')->default(null)->nullable()->after('is_policy_agreement_email_sent');

            $table->boolean('is_policy_agreement_signed')->default(false)->nullable()->after('policy_agreement_email_sent_date');
            $table->dateTime('policy_agreement_signed_date')->default(null)->nullable()->after('is_policy_agreement_signed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cme_speakers', function (Blueprint $table) {
            //
            $table->dropColumn(['is_policy_agreement_email_sent','policy_agreement_email_sent_date','is_policy_agreement_signed','policy_agreement_signed_date']);
        });
        Schema::table('cme_activity_administrators', function (Blueprint $table) {
            //
            $table->dropColumn(['is_policy_agreement_email_sent','policy_agreement_email_sent_date','is_policy_agreement_signed','policy_agreement_signed_date']);
        });
    }
};
