<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosen')->insert([
            [
                'name' => 'Nur Khoiriyah,S.Gz',
                'nidn' => '2147483647',
                'email' => 'nur@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Agustin Sukarsono,ST.,M.Agr.,IPM',
                'nidn' => '701126303',
                'email' => 'agustin@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Denny Kurniawati,S.TP.,M.Agr',
                'nidn' => '1987654321',
                'email' => 'denny@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Ifan Ali Muntaha,ST.,M.kom',
                'nidn' => '11223885532',
                'email' => 'irfan@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Achmad Syaichu,ST.,MP',
                'nidn' => '7553473322',
                'email' => 'achmad@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Sukarni,ST.,MM',
                'nidn' => '7545898455',
                'email' => 'sukarni@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Jarwo,ST.,MM',
                'nidn' => '117712565',
                'email' => 'jarwo@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Anang Efendi,ST.,MM',
                'nidn' => '19675777775',
                'email' => 'anang@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Erna Habibah,SE.,MM',
                'nidn' => '15682334466',
                'email' => 'erna@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Putut Ade Irawan,ST.,MT',
                'nidn' => '7722377455',
                'email' => 'putut@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'M. Jamaludin,S.Kom.,MT',
                'nidn' => '2892334455',
                'email' => 'jamal@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Dwi Wibobo,ST.,MM.,M.Kom',
                'nidn' => '998803955',
                'email' => 'dwi@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Ardath Prahara S.S.Kom.,M.T',
                'nidn' => '4567833456',
                'email' => 'ardath@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Luhur Pambudi Herdanarpati,ST.,MT',
                'nidn' => '198265455',
                'email' => 'luhur@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Robiatul Adawiyah,ST.,MM',
                'nidn' => '1112255245',
                'email' => 'robiatul@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Mahmut All-imron,ST.,MM',
                'nidn' => '900764354',
                'email' => 'mahmut@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Agus Danis,ST',
                'nidn' => '76438999',
                'email' => 'agus@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Chaisal Albar,SE',
                'nidn' => '865246777',
                'email' => 'chaisal@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'syaifudin zuhri',
                'nidn' => '998775777',
                'email' => 'syaifudin@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Agus Kurniawan',
                'nidn' => '096533477',
                'email' => 'agusk@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Haidar Ali Akbar,S.Kom',
                'nidn' => '09811234',
                'email' => 'haidar@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'widodo,S.Kom.,M.Kom',
                'nidn' => '098112343',
                'email' => 'widodo@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Ibnu Sodik,S.Kom',
                'nidn' => '098736273',
                'email' => 'sodik@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'M. Abdurrouf,S.Kom',
                'nidn' => '08728873',
                'email' => 'abdur@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'M. Arif Asyathori,ST',
                'nidn' => '098457666',
                'email' => 'arifas@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'kaprodi',
                'nidn' => '01010101',
                'email' => 'kaprodi@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
            [
                'name' => 'Puket Bidang Kemahasiswaan',
                'nidn' => '02020202',
                'email' => 'puket@gmail.com',
                'password' => Hash::make('1234567890'),
            ],
        ]);

    
    }
}
