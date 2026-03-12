<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@pelita.com',
            'password' => Hash::make('sadmin123'),
            'role' => 'super_admin',
            'jabatan' => 'Kepala Bagian',
            'instansi' => 'Cimahi Technopark',
            'no_telp' => '081234567890',
            'alamat' => 'Jl. Baros No. 1, Cimahi',
            'no_ktp' => '3204050909990001',
            'kelurahan' => 'Baros',
            'kecamatan' => 'Cimahi Tengah',
            'kabupaten' => 'Cimahi',
            'kode_pos' => '40521',
            'nama_organisasi' => 'Cimahi Technopark'
        ]);

        // Admin / CS
        User::create([
            'name' => 'Admin CS',
            'email' => 'admin@pelita.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'jabatan' => 'Customer Service',
            'instansi' => 'Cimahi Technopark',
            'no_telp' => '081298765432',
            'alamat' => 'Jl. Leuwigajah No. 2, Cimahi',
            'no_ktp' => '3204050911110002',
            'kelurahan' => 'Leuwigajah',
            'kecamatan' => 'Cimahi Selatan',
            'kabupaten' => 'Cimahi',
            'kode_pos' => '40533',
            'nama_organisasi' => 'Cimahi Technopark'
        ]);

        // Pengurus Aset
        User::create([
            'name' => 'Pengurus Aset',
            'email' => 'pengurus@pelita.com',
            'password' => Hash::make('pengurus123'),
            'role' => 'pengurus_aset',
            'jabatan' => 'Pengurus Aset',
            'instansi' => 'Cimahi Technopark',
            'no_telp' => '081211112222',
            'alamat' => 'Jl. Cibeber No. 4, Cimahi',
            'no_ktp' => '3204050922220003',
            'kelurahan' => 'Cibeber',
            'kecamatan' => 'Cimahi Selatan',
            'kabupaten' => 'Cimahi',
            'kode_pos' => '40531',
            'nama_organisasi' => 'Cimahi Technopark'
        ]);

        // User Biasa
        User::create([
            'name' => 'Muhamad Aliph',
            'email' => 'user@pelita.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'jabatan' => 'Pemohon',
            'instansi' => 'Umum',
            'no_telp' => '081200011122',
            'alamat' => 'Jl. Citeureup No. 3, Cimahi',
            'no_ktp' => '3204050933330004',
            'kelurahan' => 'Citeureup',
            'kecamatan' => 'Cimahi Utara',
            'kabupaten' => 'Cimahi',
            'kode_pos' => '40512',
            'nama_organisasi' => 'Komunitas Pemuda Cimahi'
        ]);
    }
}
