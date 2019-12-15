<?php

use Illuminate\Database\Seeder;

class MakananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('makanans')->insert([
        	'name' => 'Meal A',
        	'harga' => 14000,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('makanans')->insert([
        	'name' => 'Meal B',
        	'harga' => 25000,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
