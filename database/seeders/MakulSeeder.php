<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('makul')->insert([
            ['id_dosen' => 1, 'nama' => 'Dasar-Dasar Higiene', 'kode' => 'MK-001', 'jurusan' => 'GAB', 'semester' => 1],
            ['id_dosen' => 19, 'nama' => 'Mikrobiologi', 'kode' => 'MK-002', 'jurusan' => 'GAB', 'semester' => 1],
            ['id_dosen' => 20, 'nama' => 'PTSA', 'kode' => 'MK-003', 'jurusan' => 'GAB', 'semester' => 1],
            ['id_dosen' => 2, 'nama' => 'Pengantar Teknik Industri', 'kode' => 'MK-004', 'jurusan' => 'TID', 'semester' => 3],
            ['id_dosen' => 21, 'nama' => 'Algoritma dan Pemrograman 2', 'kode' => 'MK-005', 'jurusan' => 'TIF', 'semester' => 3],
            ['id_dosen' => 3, 'nama' => 'Manajemen Kualitas', 'kode' => 'MK-006', 'jurusan' => 'TID', 'semester' => 3],
            ['id_dosen' => 21, 'nama' => 'Pemrograman Komputer 1 (2/1)', 'kode' => 'MK-007', 'jurusan' => 'TIF', 'semester' => 3],
            ['id_dosen' => 5, 'nama' => 'Thermodinamika Teknik', 'kode' => 'MK-008', 'jurusan' => 'TID', 'semester' => 3],
            ['id_dosen' => 4, 'nama' => 'Digital Preneur', 'kode' => 'MK-009', 'jurusan' => 'GAB', 'semester' => 5],
            ['id_dosen' => 2, 'nama' => 'Manajemen Proyek', 'kode' => 'MK-010', 'jurusan' => 'TID', 'semester' => 5],
            ['id_dosen' => 6, 'nama' => 'Artificial Intelligence', 'kode' => 'MK-011', 'jurusan' => 'TIF', 'semester' => 5],
            ['id_dosen' => 24, 'nama' => 'Kerja Praktek', 'kode' => 'MK-012', 'jurusan' => 'GAB', 'semester' => 7],
            ['id_dosen' => 2, 'nama' => 'Manajemen Umum', 'kode' => 'MK-013', 'jurusan' => 'GAB', 'semester' => 1],
            ['id_dosen' => 9, 'nama' => 'Pengantar Ilmu Ekonomi', 'kode' => 'MK-014', 'jurusan' => 'TID', 'semester' => 1],
            ['id_dosen' => 27, 'nama' => 'Interpreneur, Pola Marketing & Keuangan Sederhana', 'kode' => 'MK-015', 'jurusan' => 'GAB', 'semester' => 1],
            ['id_dosen' => 10, 'nama' => 'Mekanika Teknik', 'kode' => 'MK-016', 'jurusan' => 'TID', 'semester' => 3],
            ['id_dosen' => 22, 'nama' => 'Sistem Digital', 'kode' => 'MK-017', 'jurusan' => 'TIF', 'semester' => 3],
            ['id_dosen' => 3, 'nama' => 'Statistika Teknik', 'kode' => 'MK-018', 'jurusan' => 'GAB', 'semester' => 3],
            ['id_dosen' => 10, 'nama' => 'Pengetahuan Bahan Teknik', 'kode' => 'MK-019', 'jurusan' => 'TID', 'semester' => 3],
            ['id_dosen' => 23, 'nama' => 'Web Programing', 'kode' => 'MK-020', 'jurusan' => 'TIF', 'semester' => 3],
            ['id_dosen' => 13, 'nama' => 'Elektronika Dasar', 'kode' => 'MK-021', 'jurusan' => 'TIF', 'semester' => 3],
            ['id_dosen' => 9, 'nama' => 'Komunikasi Personal', 'kode' => 'MK-022', 'jurusan' => 'GAB', 'semester' => 5],
            ['id_dosen' => 10, 'nama' => 'Ekonomi Teknik', 'kode' => 'MK-023', 'jurusan' => 'TID', 'semester' => 5],
            ['id_dosen' => 22, 'nama' => 'Rekayasa Perangkat Lunak', 'kode' => 'MK-024', 'jurusan' => 'TIF', 'semester' => 5],
            ['id_dosen' => 11, 'nama' => 'Internet Of Thing (IOT)', 'kode' => 'MK-025', 'jurusan' => 'TIF', 'semester' => 5],
            ['id_dosen' => 3, 'nama' => 'Pengendalian Kualitas', 'kode' => 'MK-026', 'jurusan' => 'TID', 'semester' => 5],
            ['id_dosen' => 18, 'nama' => 'Mitigasi dan Survive', 'kode' => 'MK-027', 'jurusan' => 'GAB', 'semester' => 1],
            ['id_dosen' => 16, 'nama' => 'Pengenalan Annubuwwah', 'kode' => 'MK-028', 'jurusan' => 'GAB', 'semester' => 1],
            ['id_dosen' => 12, 'nama' => 'Pengantar Teknologi Informasi', 'kode' => 'MK-029', 'jurusan' => 'TIF', 'semester' => 1],
            ['id_dosen' => 14, 'nama' => 'Elemen Mesin (Teknologi Mekanik)', 'kode' => 'MK-030', 'jurusan' => 'TID', 'semester' => 3],
            ['id_dosen' => 5, 'nama' => 'Menggambar Teknik', 'kode' => 'MK-031', 'jurusan' => 'TID', 'semester' => 3],
            ['id_dosen' => 7, 'nama' => 'Matematika Teknik', 'kode' => 'MK-032', 'jurusan' => 'TIF', 'semester' => 3],
            ['id_dosen' => 15, 'nama' => 'Analisis dan Desain Sistem Informasi', 'kode' => 'MK-033', 'jurusan' => 'TIF', 'semester' => 3],
            ['id_dosen' => 17, 'nama' => 'Teknologi E-Bussines', 'kode' => 'MK-034', 'jurusan' => 'GAB', 'semester' => 5],
            ['id_dosen' => 8, 'nama' => 'Jaringan dan Komunikasi Data', 'kode' => 'MK-035', 'jurusan' => 'TIF', 'semester' => 5],
            ['id_dosen' => 5, 'nama' => 'Manajemen Rekayasa Sistem Fasilitas', 'kode' => 'MK-036', 'jurusan' => 'TID', 'semester' => 5],
            ['id_dosen' => 12, 'nama' => 'Aplikasi Teknologi Informasi', 'kode' => 'MK-037', 'jurusan' => 'TID', 'semester' => 5],
            ['id_dosen' => 12, 'nama' => 'Pemrograman Komputer III (3/1)', 'kode' => 'MK-038', 'jurusan' => 'TIF', 'semester' => 5],
            ['id_dosen' => 24, 'nama' => 'Seminar-Sidang Tugas Akhir', 'kode' => 'MK-040', 'jurusan' => 'GAB', 'semester' => 9],
            ['id_dosen' => 25, 'nama' => 'Pramuka', 'kode' => 'MK-041', 'jurusan' => 'GAB', 'semester' => 1],
        ]);
    }
}
