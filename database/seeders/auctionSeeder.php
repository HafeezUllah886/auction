<?php

namespace Database\Seeders;

use App\Models\auctions;
use App\Models\warehouses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class auctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Auction 1"],
            ['name' => "Auction 2"],
            ['name' => "Auction 3"],
        ];
        auctions::insert($data);
    }
}
