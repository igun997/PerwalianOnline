<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_kriteria', function (Blueprint $table) {
          $table->increments('id_event_kriteria');
          $table->unsignedInteger('id_event');
          $table->string('nama');
          $table->double('bobot');
          $table->timestamps();
          $table->foreign('id_event')
          ->references('id_event')->on('event')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_kriteria');
    }
}
