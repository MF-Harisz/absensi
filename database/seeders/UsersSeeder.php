<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'      => 'Mochammad Nurcahyono',
                'nim'       => '2201001927',
                'semester'  => 7,
                'jurusan'   => 'TIF',
                'email'     => 'cahyo@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
            [
                'name'      => 'Rina Kartika',
                'nim'       => '1234567890',
                'semester'  => 7,
                'jurusan'   => 'TID',
                'email'     => 'rina@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
            [
                'name'      => 'Anita Cantika',
                'nim'       => '1234567743',
                'semester'  => 7,
                'jurusan'   => 'TIF',
                'email'     => 'anita@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
            [
                'name'      => 'Agus Prayogy',
                'nim'       => '12345677870',
                'semester'  => 7,
                'jurusan'   => 'TID',
                'email'     => 'agus@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
            [
                'name'      => 'Budi Santoso',
                'nim'       => '1987654321',
                'semester'  => 5,
                'jurusan'   => 'TID',
                'email'     => 'budi@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
            [
                'name'      => 'Andy Kurniawan',
                'nim'       => '1987654377',
                'semester'  => 5,
                'jurusan'   => 'TIF',
                'email'     => 'andy@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
            [
                'name'      => 'Dewi Lestari',
                'nim'       => '1122334455',
                'semester'  => 1,
                'jurusan'   => 'TIF',
                'email'     => 'dewi@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
            [
                'name'      => 'Julian Nugraha',
                'nim'       => '1122334464',
                'semester'  => 1,
                'jurusan'   => 'TID',
                'email'     => 'julian@gmail.com',
                'password'  => Hash::make('1234567890'),
            ],
        ]);
    }
}
