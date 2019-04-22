<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = \Burung\Users::create(["nama"=>"admin","alamat"=>"admin","username"=>"admin","password"=>"admin","email"=>"admin@admin.com","hp"=>"0678"]);
    }
}
