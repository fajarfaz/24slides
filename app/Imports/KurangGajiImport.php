<?php

namespace App\Imports;

use App\PenguranganGaji;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KurangGajiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PenguranganGaji([
            'karyawans_id' => $row['id_karyawan'],
            'nominal' => $row['nominal'],
            'detail' => $row['detail'],
        ]);
    }
}
