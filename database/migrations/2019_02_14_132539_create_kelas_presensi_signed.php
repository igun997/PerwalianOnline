<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasPresensiSigned extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelas_presensi_signed', function (Blueprint $table) {
          $table->increments('id_ps');
          $table->unsignedInteger('id_presensi');
          $table->unsignedInteger('id_user');
          $table->enum("presensi",["S","I","A","T"]);
          $table->timestamps();
          $table->foreign('id_presensi')->references('id_presensi')->on('tbl_kelas_presensi')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_kelas_presensi_signed');
    }
}
