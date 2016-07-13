<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name_id')->index();
            $table->date('donation_date')->nullable();
            $table->string('location')->nullable();
            $table->string('occupation')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('amount', 50)->nullable();
            $table->string('recipient', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('donations');
    }
}
