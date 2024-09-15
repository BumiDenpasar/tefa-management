<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 0; $i < 100; $i++) {
            \App\Models\School::create([
                'nama_sekolah' => $faker->company,
                'nama_tefa' => $faker->unique()->catchPhrase,
                'deskripsi' => $faker->paragraph,
                'no_kontak' => $faker->phoneNumber,
                'npsn' => $faker->randomNumber(9),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}