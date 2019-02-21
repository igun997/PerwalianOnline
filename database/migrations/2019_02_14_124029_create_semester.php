<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemester extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_semester', function (Blueprint $table) {
          $table->increments('id_semester');
          $table->string('nama_semester',4);
          $table->unsignedInteger('id_tajar');
          $table->timestamps();
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
        Schema::dropIfExists('tbl_semester');
    }
}
