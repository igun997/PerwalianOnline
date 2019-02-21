<?php

use Illuminate\Database\Seeder;

class semester extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $create = new \SIAK\SemesterModel;
      $create->nama_semester = "I";
      $create->id_tajar = 1;
      $create->save();
    }
}
