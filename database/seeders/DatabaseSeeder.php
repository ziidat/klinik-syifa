<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\rm;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
    
        User::create([
            'username' => 'fauzi',
            'name' => 'Achmad Fauzi',
            'email' => 'achmadfauzi987@gmail.com',
            'admin' => '1',
            'Profesi' => 'Petugas',
            'Avatar' => 'default.jpg',
            'password' => bcrypt('adminadmin')
        ]);

        User::create([
            'username' => 'dokter',
            'name' => 'Dr. Ibral',
            'email' => 'ibral@gmail.com',
            'admin' => '0',
            'Profesi' => 'Dokter',
            'Avatar' => 'default.jpg',
            'password' => bcrypt('dokterdokter')
        ]);

        rm::create([
            'idpasien' => '1',
            'keluhan' => 'Meriang',
            'anamnesis' => 'Demam 10 hari',
            'cekfisik' => 'T:38.7',
            'lab' => '1|2',
            'hasil' => '100|100',
            'diagnosis' => 'Tipes',
            'resep' => '1|2',
            'jumlah' => '10|10',
            'aturan' => '3x1|3x1',
            'dokter' => '2'
        ]);
    }
}
