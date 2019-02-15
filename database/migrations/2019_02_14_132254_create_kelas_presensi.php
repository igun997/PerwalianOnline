<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasPresensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelas_presensi', function (Blueprint $table) {
          $table->increments('id_presensi');
          $table->string('topik_pembahasan',200);
          $table->unsignedInteger("id_kelas");
          $table->timestamps();
          $table->foreign('id_kelas')->references('id_kelas')->on('tbl_kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kelas_presensi');
    }
}
