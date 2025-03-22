<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::connection('consultation')->table(('users'))->insert([
            'nama' => 'Dontol',
            'alamat' => 'mars',
            'no_hp' => '+99 000-0000-0000',
            'email' => 'dontolbeban@yahoo.com',
            'password' => 'admin',
            'role' => 'pasien',
            'remember_token' => '-'
        ]);

        DB::connection('consultation')->table(('users'))->insert([
            'nama' => 'Adit',
            'alamat' => 'bumi',
            'no_hp' => '+62 000-0000-0000',
            'email' => 'aditdokter@yahoo.com',
            'password' => 'pass',
            'role' => 'dokter',
            'remember_token' => '-'
        ]);
    }
}
