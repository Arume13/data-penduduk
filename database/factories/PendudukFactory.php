<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PendudukFactory extends Factory
{
    public function definition()
    {
        $jenisKelamin = $this->faker->randomElement(['Laki-laki', 'Perempuan']);
        $pekerjaan = $jenisKelamin == 'Laki-laki' 
            ? $this->faker->randomElement(['Karyawan Swasta', 'Pegawai Negeri', 'Wiraswasta', 'Petani'])
            : $this->faker->randomElement(['Ibu Rumah Tangga', 'Guru', 'Perawat', 'Pegawai Swasta']);
            
        return [
            'noKK' => function () {
                return \App\Models\KK::inRandomOrder()->first()->noKK ?? 
                       \App\Models\KK::factory()->create()->noKK;
            },
            'nik' => $this->faker->unique()->numerify('###############'),
            'nama' => $this->faker->name($jenisKelamin == 'Laki-laki' ? 'male' : 'female'),
            'tempatLahir' => $this->faker->city,
            'tanggalLahir' => $this->faker->date('Y-m-d', '-'.rand(10, 70).' years'),
            'jenisKelamin' => $jenisKelamin,
            'pekerjaan' => $pekerjaan,
            'kategori' => $this->faker->randomElement(['Dewasa', 'Anak-anak', 'Lansia']),
            'statusPerkawinan' => $this->faker->randomElement(['Menikah', 'Belum Menikah', 'Cerai']),
            'alamat' => $this->faker->address,
            'rt' => str_pad($this->faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
            'rw' => str_pad($this->faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
            'noRumah' => $this->faker->numberBetween(1, 100),
        ];
    }
}
