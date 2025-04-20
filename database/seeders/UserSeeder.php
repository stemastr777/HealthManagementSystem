<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Dontol',
                'alamat' => 'Mars',
                'no_hp' => '+99 000-0000-0000',
                'email' => 'dontolbeban@yahoo.com',
                'password' => 'dontol',
                'role' => 'pasien',
                'remember_token' => 'false',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Adit',
                'alamat' => 'Bumi',
                'no_hp' => '+62 000-0000-0000',
                'email' => 'aditdokter@yahoo.com',
                'password' => 'adit',
                'role' => 'dokter',
                'remember_token' => 'false',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Iqbal',
                'alamat' => 'Semarang',
                'no_hp' => '081234567690',
                'email' => 'budi.pasien@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pasien',
                'remember_token' => 'false',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'dr. Farhan',
                'alamat' => 'Semarang',
                'no_hp' => '089876543210',
                'email' => 'siti.dokter@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'dokter',
                'remember_token' => 'false',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['nama' => $user['nama']],
                [
                    'alamat' => $user['alamat'], 
                    'no_hp' => $user['no_hp'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'role' => $user['role'],
                    'remember_token' => $user['remember_token'],
                    'created_at' => $user['created_at'],
                    'updated_at' => $user['updated_at'],
                ]
            );
        }
    }
}
