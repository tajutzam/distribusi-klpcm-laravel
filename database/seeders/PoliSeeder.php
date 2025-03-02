<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $polis = [
            [
                'name' => 'Popy',
                'no_wa' => '082189465326',
                'nip' => '123456789', // Gantilah dengan NIP yang sesuai
                'poly' => 'POLI UMUM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nanda',
                'no_wa' => '082189465326',
                'nip' => '123456790',
                'poly' => 'POLI GIGI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gibran',
                'no_wa' => '082189465326',
                'nip' => '123456791',
                'poly' => 'POLI KIA/KB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tika',
                'no_wa' => '082189465326',
                'nip' => '123456792',
                'poly' => 'POLI MTBS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('polis')->insert($polis);
    }
}
