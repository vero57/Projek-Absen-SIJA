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
                'role_id' => 1,
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Matematika',
                'role_id' => 2,
                'email' => 'guru1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Fisika',
                'role_id' => 2,
                'email' => 'guru2@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Biologi',
                'role_id' => 2,
                'email' => 'guru3@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Kimia',
                'role_id' => 2,
                'email' => 'guru4@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Bahasa Indonesia',
                'role_id' => 2,
                'email' => 'guru5@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Guru Bahasa Inggris',
                'role_id' => 2,
                'email' => 'guru6@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Siswa Satu',
                'role_id' => 3,
                'email' => 'siswa@example.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
