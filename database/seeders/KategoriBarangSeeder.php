<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBarang;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Audio Visual', 'deskripsi' => 'Peralatan presentasi seperti proyektor, sound system'],
            ['nama_kategori' => 'Furniture', 'deskripsi' => 'Kursi, meja, backdrop, etalase'],
            ['nama_kategori' => 'Komputer & IT', 'deskripsi' => 'PC, laptop, perangkat multimedia, VR'],
            ['nama_kategori' => 'Alat Studio', 'deskripsi' => 'Lampu studio, mikrofon, mixer, kamera'],
            ['nama_kategori' => 'Olahraga & Outdoor', 'deskripsi' => 'Alat fitness outdoor dan fasilitas taman'],
        ];

        foreach ($data as $item) {
            KategoriBarang::create($item);
        }
    }
}
