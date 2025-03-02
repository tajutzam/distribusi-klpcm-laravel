<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::create(
            [
                'nip' => '91230912039210',
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('rahasia'),
                'role' => 'admin'
            ]
        );
        User::create(
            [
                'nip' => '91230912039212',
                'name' => 'petugas loket',
                'username' => 'petugas loket',
                'password' => bcrypt('rahasia'),
                'role' => 'petugas loket'
            ]
        );
        User::create(
            [
                'nip' => '91230912039212',
                'name' => 'petugas penyimpanan',
                'username' => 'petugas penyimpanan',
                'password' => bcrypt('rahasia'),
                'role' => 'petugas penyimpanan'
            ]
        );
        User::create(
            [
                'nip' => '91230912039211',
                'name' => 'kepala puskesmas',
                'username' => 'kepala puskesmas',
                'password' => bcrypt('rahasia'),
                'role' => 'kepala puskesmas'
            ]
        );
    }
}
