<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('logoUrl')->nullable();
            $table->string('header')->nullable();
            $table->string('subHeader')->nullable();
            $table->string('backgroundUrl')->nullable();
            $table->string('layoutMenu')->nullable();
            $table->integer('columns')->nullable();
            $table->string('css')->nullable();
            $table->string('font')->nullable();
            $table->string('websiteUrl')->nullable();
            $table->string('openingTime')->nullable();
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
        Schema::dropIfExists('setup');
    }
}
