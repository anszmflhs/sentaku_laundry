<?php

namespace Database\Seeders;

use App\Models\PriceList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pricelists = [
            [
                'quantity' => '1kg',
                'harga' => '4000',
                'another' => 'Selimut',
                'hargaanother' => '4000',
            ],
            [
                'quantity' => '2kg',
                'harga' => '80000',
                'another' => 'Gorden',
                'hargaanother' => '12000',
            ],
            [
                'quantity' => '3kg',
                'harga' => '12000',
                'another' => 'Karpet',
                'hargaanother' => '20000',
            ],
        ];
        foreach ($pricelists as $value) {
            PriceList::create($value);
        }
    }
}
