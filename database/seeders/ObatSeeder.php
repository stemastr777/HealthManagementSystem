<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::connection('consultation')->table(('obats'))->insert([
            'nama_obat' => 'Meth',
            'kemasan' => 'kapsul',
            'harga' => 200_000,
        ]);
    }
}
