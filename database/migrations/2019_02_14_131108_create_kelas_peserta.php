<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasPeserta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelas_peserta', function (Blueprint $table) {
          $table->increments('id_peserta');
          $table->unsignedInteger('id_kelas');
          $table->unsignedInteger('id_user');
          $table->char("nilai_akhir",1);
          $table->timestamps();
          $table->foreign('id_kelas')->references('id_kelas')->on('tbl_kelas')->onDelete('cascade');
          $table->foreign('id_user')->references('id_user')->on('tbl_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kelas_peserta');
    }
}
