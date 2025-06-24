<?php

namespace Database\Seeders;

use App\Models\KK;
use Illuminate\Database\Seeder;

class KKSeeder extends Seeder
{
    public function run()
    {
        // Membuat 10 KK secara random
        KK::factory()->count(10)->create()->each(function ($kk) {
            // Untuk 30% KK, buat tanpa anggota keluarga
            if (rand(1, 10) > 3) {
                // Setiap KK memiliki 1-5 anggota keluarga
                \App\Models\Penduduk::factory()
                    ->count(rand(1, 5))
                    ->create(['noKK' => $kk->noKK]);
            }
        });
        
        // Membuat contoh data yang pasti ada
        $kkContoh = KK::create([
            'noKK' => '1234567890123456',
            'kepalaKeluarga' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10',
            'rt' => '01',
            'rw' => '05',
            'noRumah' => '10',
        ]);

        // Anggota keluarga untuk KK contoh
        \App\Models\Penduduk::create([
            'noKK' => $kkContoh->noKK,
            'nik' => '1234567890123456',
            'nama' => 'Budi Santoso',
            'tempatLahir' => 'Jakarta',
            'tanggalLahir' => '1980-01-15',
            'jenisKelamin' => 'Laki-laki',
            'pekerjaan' => 'Wiraswasta',
            'kategori' => 'Dewasa',
            'statusPerkawinan' => 'Menikah',
            'alamat' => $kkContoh->alamat,
            'rt' => $kkContoh->rt,
            'rw' => $kkContoh->rw,
            'noRumah' => $kkContoh->noRumah,
        ]);

        \App\Models\Penduduk::create([
            'noKK' => $kkContoh->noKK,
            'nik' => '2345678901234567',
            'nama' => 'Ani Budianti',
            'tempatLahir' => 'Bandung',
            'tanggalLahir' => '1985-05-20',
            'jenisKelamin' => 'Perempuan',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'kategori' => 'Dewasa',
            'statusPerkawinan' => 'Menikah',
            'alamat' => $kkContoh->alamat,
            'rt' => $kkContoh->rt,
            'rw' => $kkContoh->rw,
            'noRumah' => $kkContoh->noRumah,
        ]);

        \App\Models\Penduduk::create([
            'noKK' => $kkContoh->noKK,
            'nik' => '3456789012345671',
            'nama' => 'Cindy Budi',
            'tempatLahir' => 'Jakarta',
            'tanggalLahir' => '2010-08-15',
            'jenisKelamin' => 'Perempuan',
            'pekerjaan' => 'Pelajar',
            'kategori' => 'Anak-anak',
            'statusPerkawinan' => 'Belum Menikah',
            'alamat' => $kkContoh->alamat,
            'rt' => $kkContoh->rt,
            'rw' => $kkContoh->rw,
            'noRumah' => $kkContoh->noRumah,
        ]);
    }
}
