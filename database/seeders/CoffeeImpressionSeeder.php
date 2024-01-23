<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoffeeImpressionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('CoffeeImpressions')->insert([
            'coffeeName' => 'コロンビア',
            'purchaseDate' => Carbon::now(),
            'price' => 500,
            'place' => 'Coffee Shop',
            'rate' => 4,
            'scent' => 3,
            'acidity' => 2,
            'bitter' => 3,
            'rich' => 4,
            'taste' => 5,
        ]);
    }
}
