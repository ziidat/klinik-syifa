<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = [
    [
       'username' => 'fauzi',
       'name' => 'Achmad Fauzi',
       'email' => 'achmadfauzi@mhs.pelitabangsa.ac.id',
       'admin' => '1',
       'Profesi' => 'Petugas',
       'Avatar' => 'default.jpg',
       'password' => bcrypt('adminadmin')
   ],
   [
        'username' => 'dokter',
        'name' => 'Dr. Ibral',
        'email' => 'ibral@gmail.com',
        'admin' => '0',
        'Profesi' => 'Dokter',
        'Avatar' => 'default.jpg',
        'password' => bcrypt('dokterdokter')
   ]
    ];
    foreach ($user as $key => $value) {
        User::create($value);
    }
    }
}
