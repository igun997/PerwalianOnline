<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPeserta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_peserta', function (Blueprint $table) {
          $table->increments('id_event_peserta');
          $table->unsignedInteger('id_event');
          $table->unsignedInteger('id_users');
          $table->integer('no_gantangan');
          $table->string('foto_burung')->nullable();
          $table->timestamps();
          $table->foreign('id_event')
          ->references('id_event')->on('event')
          ->onDelete('cascade');
          $table->foreign('id_users')
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
        Schema::dropIfExists('event_peserta');
    }
}
