<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countryCodes = [
            ["code" => "US", "name" => "United States"],
            ["code" => "CA", "name" => "Canada"],
            ["code" => "GB", "name" => "United Kingdom"],
            ["code" => "IN", "name" => "India"],
            ["code" => "AU", "name" => "Australia"],
            ["code" => "DE", "name" => "Germany"],
            ["code" => "FR", "name" => "France"],
            ["code" => "IT", "name" => "Italy"],
            ["code" => "JP", "name" => "Japan"],
            ["code" => "CN", "name" => "China"]
        ];

        DB::table('country')->insert($countryCodes);
    }
}
