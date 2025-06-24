<?php

namespace Database\Seeders;

use App\Models\warehouses;
use App\Models\yards;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class yardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Yard 1"],
            ['name' => "Yard 2"],
            ['name' => "Yard 3"],
        ];
        yards::insert($data);
    }
}
