<?php

namespace App\Imports;

use App\Absensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Absensi([
            'karyawans_id' => $row['id_karyawan'],
            'jam_masuk' => $row['jam_masuk'],
            'jam_keluar' => $row['jam_keluar'],
            'tanggal'   => $row['tanggal']
        ]);
    }
}
