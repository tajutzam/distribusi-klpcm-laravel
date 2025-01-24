<?php

namespace App\Imports;

use App\Models\DataPasien;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class PasienImport implements ToModel
{
    public function model(array $row)
    {
        return new DataPasien([
            'no_rm' => $row[0],
            'kode_wilayah' => $row[1],
            'nama' => $row[2]
        ]);
    }
}
