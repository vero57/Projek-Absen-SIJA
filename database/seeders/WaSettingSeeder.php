<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wa_settings')->insert([
            [
                'api_key' => 'default_api_key',
                'phone_number' => '6281234567890',
                'is_active' => true,
            ],
        ]);
    }
}
