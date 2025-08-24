<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Matematika',
                'email' => 'guru1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Fisika',
                'email' => 'guru2@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Biologi',
                'email' => 'guru3@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Kimia',
                'email' => 'guru4@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Bahasa Indonesia',
                'email' => 'guru5@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Bahasa Inggris',
                'email' => 'guru6@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Siswa Satu',
                'email' => 'siswa@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Ortu Siswa Satu',
                'email' => 'ortu@example.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
