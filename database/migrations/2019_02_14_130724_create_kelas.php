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
            $table->string('ruangan_kelas');
            $table->double('kuota_kelas');
            $table->unsignedInteger('id_matkul');
            $table->unsignedInteger('id_user');
            $table->timestamps();
            $table->foreign('id_matkul')->references('id_matkul')->on('tbl_matkul')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_kelas');
    }
}
