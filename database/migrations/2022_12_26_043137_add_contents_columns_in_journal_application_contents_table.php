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
        Schema::table('journal_application_contents', function (Blueprint $table) {
            $table->text('declaration')->nullable()->default(null)->after('key_value');
            $table->text('appendix')->nullable()->default(null)->after('key_value');
            $table->text('lessons_learned')->nullable()->default(null)->after('key_value');
            $table->text('technical_note_structure')->nullable()->default(null)->after('key_value');
            $table->text('summary')->nullable()->default(null)->after('key_value');
            $table->text('result')->nullable()->default(null)->after('key_value');
            $table->text('acknowledgement')->nullable()->default(null)->after('key_value');
            $table->text('methods')->nullable()->default(null)->after('key_value');
            $table->text('conflict_of_interst')->nullable()->default(null)->after('key_value');
            $table->text('references')->nullable()->default(null)->after('key_value');
            $table->text('case_description')->nullable()->default(null)->after('key_value');
            $table->text('abstract')->nullable()->default(null)->after('key_value');
            $table->text('conclusion')->nullable()->default(null)->after('key_value');
            $table->text('material_figures')->nullable()->default(null)->after('key_value');
            $table->text('main_text')->nullable()->default(null)->after('key_value');
            $table->text('discussion')->nullable()->default(null)->after('key_value');
            $table->text('body')->nullable()->default(null)->after('key_value');
            $table->text('introduction')->nullable()->default(null)->after('key_value');
            $table->text('background')->nullable()->default(null)->after('key_value');
            $table->text('keywords')->nullable()->default(null)->after('key_value');
            $table->text('author_info')->nullable()->default(null)->after('key_value');
            $table->text('author_name')->nullable()->default(null)->after('key_value');
            $table->text('title')->nullable()->default(null)->after('key_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journal_application_contents', function (Blueprint $table) {
            $table->dropColumn(['title',
            'author_name',
            'author_info',
            'keywords',
            'background',
            'abstract',
            'introduction',
            'body',
            'discussion',
            'main_text',
            'material_figures',
            'conclusion',
            'references',
            'case_description',
            'acknowledgement',
            'conflict_of_interst',
            'methods',
            'result',
            'summary',
            'technical_note_structure',
            'lessons_learned',
            'appendix',
            'declaration']);
        });
    }
};
