<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::connection('consultation')->table(('periksas'))->insert([
            'id_pasien' => 2,
            'id_dokter' => 3,
            'tgl_periksa' => Carbon::now(),
            'catatan' => 'Tidak ada masalah. Dontol memang beban.',
            'biaya_periksa' => 0,
        ]);
    }
    
}
