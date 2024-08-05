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
                'name' => 'petugas',
                'username' => 'petugas',
                'password' => bcrypt('rahasia'),
                'role' => 'petugas'
            ]
        );
        User::create(
            [
                'nip' => '91230912039211',

                'name' => 'kepala',
                'username' => 'kepala',
                'password' => bcrypt('rahasia'),
                'role' => 'kepala'
            ]
        );
    }
}
