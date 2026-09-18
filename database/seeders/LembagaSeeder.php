<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lembaga;

class LembagaSeeder extends Seeder
{
    public function run(): void
    {
        $lembagas = [
            'Latiseducation',
            'Tutorindonesia',
        ];

        foreach ($lembagas as $nama) {
            Lembaga::updateOrCreate([
                'nama_lembaga' => $nama,
            ]);
        }
    }
}
