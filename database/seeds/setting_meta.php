<?php

use Illuminate\Database\Seeder;

class setting_meta extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $set = \SIAK\SettingModel::create(["meta_key"=>"tahun_ajar","meta_value"=>1]);
        $set->save();
    }
}
