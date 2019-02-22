<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelaswal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelasawal', function (Blueprint $table) {
            $table->increments('id_kelasawal');
            $table->string("kode_kelas",100)->unique();
            $table->string("nama_kelas",100);
            $table->unsignedInteger("id_tajar");
            $table->unsignedInteger("id_user");
            $table->unsignedInteger("id_jurusan");
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('tbl_users')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('tbl_jurusan')->onDelete('cascade');
            $table->foreign('id_tajar')->references('id_tajar')->on('tbl_tajar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kelasawal');
    }
}
