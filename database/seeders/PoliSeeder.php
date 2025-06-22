<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            ['nama_poli' => 'poli gigi', 'keterangan' => 'Poli khusus untuk kesehatan gigi di usia apapun.'],
            ['nama_poli' => 'poli umum', 'keterangan' => "Poli untuk pengobatan penyakit umum."],
            ['nama_poli' => 'poli anak', 'keterangan' => "Khusus untuk penanganan dari bayi hingga anak-anak."],
        ];

        foreach ($polis as $poli) {
            Poli::firstOrCreate(
                ['nama_poli' => $poli['nama_poli']],
                ['keterangan' => $poli['keterangan']]
            );
        };
    }
}
