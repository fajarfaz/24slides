<?php

use Illuminate\Database\Seeder;

class JadwalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift A',
            'id_makanan' => 1,
            'jam_mulai' => date("09:00:00"),
            'jam_selesai' => date("17:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift B',
            'id_makanan' => 1,
            'jam_mulai' => date("09:00:00"),
            'jam_selesai' => date("15:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift C',
            'id_makanan' => 1,
            'jam_mulai' => date("14:00:00"),
            'jam_selesai' => date("21:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift D',
            'id_makanan' => 1,
            'jam_mulai' => date("19:00:00"),
            'jam_selesai' => date("01:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift E',
            'id_makanan' => 1,
            'jam_mulai' => date("20:00:00"),
            'jam_selesai' => date("02:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift F',
            'id_makanan' => 1,
            'jam_mulai' => date("08:00:00"),
            'jam_selesai' => date("16:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift G',
            'id_makanan' => 1,
            'jam_mulai' => date("08:00:00"),
            'jam_selesai' => date("12:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift H',
            'id_makanan' => 1,
            'jam_mulai' => date("13:00:00"),
            'jam_selesai' => date("17:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift I',
            'id_makanan' => 1,
            'jam_mulai' => date("17:00:00"),
            'jam_selesai' => date("21:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift J',
            'id_makanan' => 1,
            'jam_mulai' => date("21:00:00"),
            'jam_selesai' => date("01:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift K',
            'id_makanan' => 1,
            'jam_mulai' => date("12:00:00"),
            'jam_selesai' => date("20:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift L',
            'id_makanan' => 1,
            'jam_mulai' => date("07:00:00"),
            'jam_selesai' => date("17:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift M',
            'id_makanan' => 1,
            'jam_mulai' => date("08:00:00"),
            'jam_selesai' => date("18:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift N',
            'id_makanan' => 1,
            'jam_mulai' => date("14:00:00"),
            'jam_selesai' => date("24:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift O',
            'id_makanan' => 2,
            'jam_mulai' => date("19:00:00"),
            'jam_selesai' => date("05:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('jadwal_shift')->insert([
        	'name' => 'Shift P',
            'id_makanan' => 2,
            'jam_mulai' => date("22:00:00"),
            'jam_selesai' => date("08:00:00"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
