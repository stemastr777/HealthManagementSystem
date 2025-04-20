<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Periksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periksa::create([
            'id_pasien' => 4,
            'id_dokter' => 5,
            'tgl_periksa' => Carbon::now(),
            'catatan' => 'Tidak ada masalah.',
            'biaya_periksa' => 0,
        ]);

        Periksa::create([
            'id_pasien' => 4,
            'id_dokter' => 7,
            'tgl_periksa' => Carbon::now()->addDay(),
            'catatan' => 'Dontol memang beban.',
            'biaya_periksa' => 0,
        ]);
    }
    
}
