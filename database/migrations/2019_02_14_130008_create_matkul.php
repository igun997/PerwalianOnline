<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatkul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_matkul', function (Blueprint $table) {
          $table->increments('id_matkul');
          $table->string('kode_matkul',100)->unique();
          $table->string('nama_matkul',100);
          $table->string('total_sks',2);
          $table->integer('pertemuan');
          $table->unsignedInteger('id_semester');
          $table->unsignedInteger('id_kurikulum');
          $table->enum('jenis',["wajib","pilihan"]);
          $table->timestamps();
          $table->foreign('id_kurikulum')->references('id_kurikulum')->on('tbl_kurikulum')->onDelete('cascade');
          $table->foreign('id_semester')->references('id_semester')->on('tbl_semester')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_matkul');
    }
}
