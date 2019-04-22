<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_penilaian', function (Blueprint $table) {
          $table->increments('id_event_penilaian');
          $table->unsignedInteger('id_event_kriteria');
          $table->unsignedInteger('id_peserta');
          $table->unsignedInteger('id_juri');
          $table->double('nilai');
          $table->timestamps();
          $table->foreign('id_event_kriteria')
          ->references('id_event_kriteria')->on('event_kriteria')
          ->onDelete('cascade');
          $table->foreign('id_peserta')
          ->references('id_users')->on('users')
          ->onDelete('cascade');
          $table->foreign('id_juri')
          ->references('id_users')->on('users')
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
        Schema::dropIfExists('event_penilaian');
    }
}
