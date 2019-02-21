<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasawalMhs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelasawal_mhs', function (Blueprint $table) {
            $table->increments('id_km');
            $table->unsignedInteger("id_kelasawal");
            $table->unsignedInteger("id_user");
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('tbl_users')->onDelete('cascade');
            $table->foreign('id_kelasawal')->references('id_kelasawal')->on('tbl_kelasawal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kelasawal_mhs');
    }
}
