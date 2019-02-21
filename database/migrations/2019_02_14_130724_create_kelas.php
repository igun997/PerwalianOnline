<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelas', function (Blueprint $table) {
            $table->increments('id_kelas');
            $table->string('nama_kelas');
            $table->enum('hari_kelas',["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"]);
            $table->time('mulai_kelas');
            $table->time('selesai_kelas');
            $table->unsignedInteger('id_ruangan');
            $table->unsignedInteger('id_matkul');
            $table->unsignedInteger('id_user');
            $table->timestamps();
            $table->foreign('id_matkul')->references('id_matkul')->on('tbl_matkul')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('tbl_users')->onDelete('cascade');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('tbl_ruangan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kelas');
    }
}
