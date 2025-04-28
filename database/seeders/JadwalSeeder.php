<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal')->insert([
            ['id_kelas' => 1, 'id_makul' => 1, 'id_dosen' => 1, 'hari' => 'Senin', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 1, 'id_makul' => 2, 'id_dosen' => 19, 'hari' => 'Senin', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 1, 'id_makul' => 3, 'id_dosen' => 20, 'hari' => 'Senin', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 2, 'id_makul' => 4, 'id_dosen' => 2, 'hari' => 'Senin', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 5, 'id_makul' => 5, 'id_dosen' => 21, 'hari' => 'Senin', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 2, 'id_makul' => 6, 'id_dosen' => 3, 'hari' => 'Senin', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 5, 'id_makul' => 7, 'id_dosen' => 21, 'hari' => 'Senin', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 2, 'id_makul' => 8, 'id_dosen' => 5, 'hari' => 'Senin', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 4, 'id_makul' => 9, 'id_dosen' => 4, 'hari' => 'Senin', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 4, 'id_makul' => 10, 'id_dosen' => 2, 'hari' => 'Senin', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 4, 'id_makul' => 11, 'id_dosen' => 6, 'hari' => 'Senin', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 3, 'id_makul' => 12, 'id_dosen' => 26, 'hari' => 'Senin', 'jam_in' => '08:00:00', 'jam_out' => '12:30:00',],
            
            ['id_kelas' => 1, 'id_makul' => 13, 'id_dosen' => 2, 'hari' => 'Selasa', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 1, 'id_makul' => 14, 'id_dosen' => 9, 'hari' => 'Selasa', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 1, 'id_makul' => 15, 'id_dosen' => 27, 'hari' => 'Selasa', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 2, 'id_makul' => 16, 'id_dosen' => 10, 'hari' => 'Selasa', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 5, 'id_makul' => 17, 'id_dosen' => 22, 'hari' => 'Selasa', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 2, 'id_makul' => 18, 'id_dosen' => 3, 'hari' => 'Selasa', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 2, 'id_makul' => 19, 'id_dosen' => 10, 'hari' => 'Selasa', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 5, 'id_makul' => 20, 'id_dosen' => 23, 'hari' => 'Selasa', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 8, 'id_makul' => 21, 'id_dosen' => 13, 'hari' => 'Selasa', 'jam_in' => '20:00:00', 'jam_out' => '21:30:00',],
            ['id_kelas' => 4, 'id_makul' => 22, 'id_dosen' => 9, 'hari' => 'Selasa', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 8, 'id_makul' => 23, 'id_dosen' => 10, 'hari' => 'Selasa', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 4, 'id_makul' => 24, 'id_dosen' => 22, 'hari' => 'Selasa', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 8, 'id_makul' => 25, 'id_dosen' => 11, 'hari' => 'Selasa', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 4, 'id_makul' => 26, 'id_dosen' => 3, 'hari' => 'Selasa', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 3, 'id_makul' => 12, 'id_dosen' => 26, 'hari' => 'Selasa', 'jam_in' => '08:00:00', 'jam_out' => '12:30:00',],

            ['id_kelas' => 1, 'id_makul' => 27, 'id_dosen' => 18, 'hari' => 'Rabu', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 1, 'id_makul' => 28, 'id_dosen' => 16, 'hari' => 'Rabu', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 8, 'id_makul' => 29, 'id_dosen' => 12, 'hari' => 'Rabu', 'jam_in' => '18:30:00', 'jam_out' => '20:00:00',],
            ['id_kelas' => 8, 'id_makul' => 30, 'id_dosen' => 14, 'hari' => 'Rabu', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 1, 'id_makul' => 31, 'id_dosen' => 5, 'hari' => 'Rabu', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 5, 'id_makul' => 32, 'id_dosen' => 7, 'hari' => 'Rabu', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 5, 'id_makul' => 33, 'id_dosen' => 15, 'hari' => 'Rabu', 'jam_in' => '11:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 4, 'id_makul' => 34, 'id_dosen' => 17, 'hari' => 'Rabu', 'jam_in' => '08:00:00', 'jam_out' => '09:30:00',],
            ['id_kelas' => 5, 'id_makul' => 35, 'id_dosen' => 8, 'hari' => 'Rabu', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 4, 'id_makul' => 36, 'id_dosen' => 5, 'hari' => 'Rabu', 'jam_in' => '09:30:00', 'jam_out' => '11:00:00',],
            ['id_kelas' => 8, 'id_makul' => 37, 'id_dosen' => 12, 'hari' => 'Rabu', 'jam_in' => '20:00:00', 'jam_out' => '21:30:00',],
            ['id_kelas' => 8, 'id_makul' => 38, 'id_dosen' => 12, 'hari' => 'Rabu', 'jam_in' => '20:00:00', 'jam_out' => '21:30:00',],
            ['id_kelas' => 3, 'id_makul' => 12, 'id_dosen' => 26, 'hari' => 'Rabu', 'jam_in' => '08:00:00', 'jam_out' => '12:30:00',],

            ['id_kelas' => 7, 'id_makul' => 39, 'id_dosen' => 26, 'hari' => 'Kamis', 'jam_in' => '08:00:00', 'jam_out' => '12:30:00',],
            ['id_kelas' => 8, 'id_makul' => 40, 'id_dosen' => 27, 'hari' => 'Kamis', 'jam_in' => '08:00:00', 'jam_out' => '11:00:00',],

        ]);
    }
}
