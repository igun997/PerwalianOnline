<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
          $table->increments('id_event');
          $table->string('nama');
          $table->date('tanggal');
          $table->text('deskripsi');
          $table->string('img_header');
          $table->unsignedInteger('id_kelas');
          $table->unsignedInteger('id_admin');
          $table->timestamps();
          $table->foreign('id_kelas')
          ->references('id_kelas')->on('kelas')
          ->onDelete('cascade');
          $table->foreign('id_admin')
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
        Schema::dropIfExists('event');
    }
}
