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
            $table->string('degree')->nullable()->after('designation');
            $table->string('phone_no')->nullable()->after('degree');
            $table->boolean('is_financial_relation_with_entity')->nullable()->after('phone_no');
            $table->string('company_name')->nullable()->after('is_financial_relation_with_entity');
            $table->string('relation_type')->nullable()->after('company_name');
            $table->string('content_area')->nullable()->after('relation_type');
            $table->boolean('is_financial_relation_with_content')->nullable()->after('content_area');
            $table->text('activity_planned')->nullable()->after('is_financial_relation_with_content');

            $table->boolean('is_disclosure_email_sent')->default(false)->nullable()->after('policy_agreement_signed_date');
            $table->dateTime('disclosure_email_sent_date')->default(null)->nullable()->after('is_disclosure_email_sent');

            $table->boolean('is_disclosure_signed')->default(false)->nullable()->after('disclosure_email_sent_date');
            $table->dateTime('disclosure_signed_date')->default(null)->nullable()->after('is_disclosure_signed');



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
            $table->dropColumn(['is_disclosure_email_sent', 'disclosure_email_sent_date', 'is_disclosure_signed', 'disclosure_signed_date',
                'degree', 'phone_no', 'is_financial_relation_with_entity', 'company_name', 'relation_type', 'content_area',
                'is_financial_relation_with_content', 'activity_planned'
            ]);
        });
    }
};
