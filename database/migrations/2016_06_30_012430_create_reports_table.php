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
        $table->date('publication_date')->nullable();
        $table->string('type', 50)->nullable();
        $table->string('public_inspection_pdf_url', 2000)->nullable();
        $table->string('html_url', 2000)->nullable();
        $table->string('pdf_url',2000)->nullable();
        $table->string('full_text_xml_url',2000)->nullable();
        $table->mediumText('full_text_xml')->nullable();
        $table->string('title')->nullable();
        $table->mediumText('excerpts')->nullable();
        $table->mediumText('agencies')->nullable();
        $table->string('document_number')->unique();
        $table->text('abstract')->nullable();
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
