<?php

namespace Database\Seeders;

use App\Models\DataPasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dataPasien = [
            ['no_rm' => '01 08 33', 'kode_wilayah' => 1, 'nama' => 'Dinda'],
            ['no_rm' => '01 08 34', 'kode_wilayah' => 1, 'nama' => 'Sinta'],
            ['no_rm' => '02 07 40', 'kode_wilayah' => 2, 'nama' => 'Yanto'],
            ['no_rm' => '01 08 28', 'kode_wilayah' => 1, 'nama' => 'Nanda'],
            ['no_rm' => '01 08 30', 'kode_wilayah' => 1, 'nama' => 'Gibran'],
            ['no_rm' => '01 08 50', 'kode_wilayah' => 1, 'nama' => 'Vania'],
            ['no_rm' => '02 08 40', 'kode_wilayah' => 2, 'nama' => 'Mega'],
            ['no_rm' => '02 09 44', 'kode_wilayah' => 2, 'nama' => 'David'],
            ['no_rm' => '02 09 10', 'kode_wilayah' => 2, 'nama' => 'Ferhard'],
            ['no_rm' => '02 08 29', 'kode_wilayah' => 2, 'nama' => 'Memi'],
            ['no_rm' => '02 08 21', 'kode_wilayah' => 2, 'nama' => 'Novi'],
        ];

        foreach ($dataPasien as $pasien) {
            DataPasien::create($pasien);
        }
    }
}
