<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('reports', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->date('publication_date');
        $table->string('type');
        $table->string('public_inspection_pdf_url');
        $table->string('html_url');
        $table->string('pdf_url');
        $table->string('full_text_xml_url');
        $table->mediumText('full_text_xml');
        $table->string('title');
        $table->mediumText('excerpts');
        $table->mediumText('agencies');
        $table->string('document_number')->unique();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reports');
    }
}
