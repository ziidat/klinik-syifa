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
           'username' => 'admin',
           'name' => 'Admin',
           'email' => 'achmadfauzi@mhs.pelitabangsa.ac.id',
           'level' => 'admin',
           'password' => bcrypt('adminadmin')
       ],
       [
            'username' => 'dokter',
            'name' => 'Dokter',
            'email' => 'achmadfauzi987@gmail.com',
            'level' => 'Dokter',
            'password' => bcrypt('dokterdokter')
       ]
       ];
    foreach ($user as $key => $value) {
        User::create($value);
    }
    }
}
