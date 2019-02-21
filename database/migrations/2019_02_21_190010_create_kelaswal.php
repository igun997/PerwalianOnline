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
            $table->string("nama_kelas",100);
            $table->year("tahun_masuk");
            $table->unsignedInteger("id_user");
            $table->timestamps();
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
        Schema::dropIfExists('tbl_kelasawal');
    }
}
