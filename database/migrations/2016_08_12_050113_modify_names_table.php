<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('names', function (Blueprint $table) {
            //
            $table->boolean('donations_processed')->default(false);
            $table->boolean('duplicates_found')->default(false);
            $table->boolean('modified')->default(false);
            $table->boolean('is_valid')->default(true);
            $table->text('name_comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('names', function (Blueprint $table) {
          $table->dropColumn('donations_processed');
          $table->dropColumn('duplicates_found');
          $table->dropColumn('modified');
          $table->dropColumn('is_valid');
          $table->dropColumn('name_comment');
        });
    }
}
