<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatkulpilih extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_matkulpilih', function (Blueprint $table) {
            $table->increments('id_matkulpilih');
            $table->unsignedInteger("id_matkul");
            $table->unsignedInteger("id_user");
            $table->unsignedInteger("id_kelasawal");
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('tbl_users')->onDelete('cascade');
            $table->foreign('id_kelasawal')->references('id_kelasawal')->on('tbl_kelasawal')->onDelete('cascade');
            $table->foreign('id_matkul')->references('id_matkul')->on('tbl_matkul')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_matkulpilih');
    }
}
