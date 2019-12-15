<?php

namespace App\Imports;

use App\PenambahanGaji;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class TambahGajiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $header = [
        'karyawans_id',  'nominal', 'detail'
    ];
    public function model(array $row)
    {
        return new PenambahanGaji([
            'karyawans_id' => $row['id_karyawan'],
            'nominal' => $row['nominal'],
            'detail' => $row['detail'],
        ]);
    }
    public $verifyHeader = true; // Header verification toggle
}
