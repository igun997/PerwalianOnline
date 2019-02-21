<?php

use Illuminate\Database\Seeder;

class tajar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = new \SIAK\TajarModel;
        $create->nama_tajar = "2018";
        $create->save();
    }
}
