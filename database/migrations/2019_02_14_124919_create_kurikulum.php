<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKurikulum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kurikulum', function (Blueprint $table) {
          $table->increments('id_kurikulum');
          $table->string('nama_kurikulum',100)->unique();
          $table->unsignedInteger('id_user');
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
        Schema::dropIfExists('tbl_kurikulum');
    }
}
