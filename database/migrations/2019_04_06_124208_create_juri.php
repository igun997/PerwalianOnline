<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juri', function (Blueprint $table) {
          $table->increments('id_role');
          $table->unsignedInteger('id_juri');
          $table->unsignedInteger('id_event');
          $table->timestamps();
          $table->foreign('id_event')
          ->references('id_event')->on('event')
          ->onDelete('cascade');
          $table->foreign('id_juri')
          ->references('id_users')->on('users')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juri');
    }
}
