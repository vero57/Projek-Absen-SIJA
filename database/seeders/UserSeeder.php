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
                'name' => 'Bu Dayu',
                'role_id' => 2,
                'email' => 'guru1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pak Doni',
                'role_id' => 2,
                'email' => 'guru2@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pak Arya',
                'role_id' => 2,
                'email' => 'guru3@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pak Kuat',
                'role_id' => 2,
                'email' => 'guru4@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pak Danu',
                'role_id' => 2,
                'email' => 'guru5@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pak Bari',
                'role_id' => 2,
                'email' => 'guru6@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Dapiq',
                'role_id' => 3,
                'email' => 'siswa1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Kanz',
                'role_id' => 3,
                'email' => 'siswa2@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Citra',
                'role_id' => 3,
                'email' => 'siswa3@example.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
