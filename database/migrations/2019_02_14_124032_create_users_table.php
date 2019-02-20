<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
          $table->increments('id_user');
          $table->string('nama_lengkap',100);
          $table->string('username',50)->unique();
          $table->string('password',100);
          $table->enum('jk',["laki-laki","perempuan"]);
          $table->text('alamat');
          $table->string('email',100)->unique();
          $table->string('no_hp',15)->unique()->nullable();
          $table->unsignedInteger('id_jurusan')->nullable();
          $table->string('no_telepon',17)->unique()->nullable();
          $table->enum('level',["mhs","dosen","admin","jurusan","sekretariat"]);
          $table->enum('status_absen',["tidak","ya"])->nullable();
          $table->enum('hapus',["tidak","ya"]);
          $table->timestamps();
          $table->foreign('id_jurusan')->references('id_jurusan')->on('tbl_jurusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
}
