<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(tajar::class);
      $this->call(semester::class);
      $this->call(users_table_seeder::class);
      $this->call(setting_meta::class);
    }
}
