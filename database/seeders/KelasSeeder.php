<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'nama'   => 'Ruang 201',
                'lokasi' => 'Gedung STT, Lantai 2',
            ],
            [
                'nama'   => 'Ruang 301',
                'lokasi' => 'Gedung STT, Lantai 3',
            ],
            [
                'nama'   => 'Ruang 302',
                'lokasi' => 'Gedung STT, Lantai 3',
            ],
            [
                'nama'   => 'Ruang 303',
                'lokasi' => 'Gedung STT, Lantai 3',
            ],
            [
                'nama'   => 'Lap Komputer',
                'lokasi' => 'Gedung STT, Lantai 2',
            ],
            [
                'nama'   => 'Perpustakaan',
                'lokasi' => 'Gedung STT, Lantai 2',
            ],
            [
                'nama'   => 'Ruang Sidang',
                'lokasi' => 'Gedung STT, Lantai 2',
            ],
            [
                'nama'   => 'Lapangan',
                'lokasi' => 'Lapangan POMOSDA',
            ],
        ]);
    }
}
