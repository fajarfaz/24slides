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
        $this->call(LevelingTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(Status_KaryawanTableSeeder::class);
        $this->call(MakananTableSeeder::class);
        $this->call(JadwalTableSeeder::class);
    }
}
