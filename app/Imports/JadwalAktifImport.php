<?php

namespace App\Imports;

use App\JadwalAktifKaryawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalAktifImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $header = [
        'tanggal',  'id_jadwal', 'id_karyawan'
    ];
    public function model(array $row)
    {
        return new JadwalAktifKaryawan([
            'tanggal'     => $row['tanggal'],
            'id_jadwal'    => $row['id_jadwal'], 
            'id_karyawan' => $row['id_karyawan'],
        ]);
    }
    public $verifyHeader = true; // Header verification toggle
    
    public $truncate = false; // We want to truncate table before the import
}
