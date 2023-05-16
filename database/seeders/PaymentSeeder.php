<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'user_id' => '1',
                'service_manages_id' => '1',
                'price_lists_id' => '1',
                'quantity' => '3',
                'total' => '8000',
                'status' => 'unpaid'
            ],
            [
                'user_id' => '2',
                'service_manages_id' => '2',
                'price_lists_id' => '2',
                'quantity' => '7',
                'total' => '20000',
                'status' => 'unpaid'
            ],
            [
                'user_id' => '3',
                'service_manages_id' => '3',
                'price_lists_id' => '3',
                'quantity' => '2',
                'total' => '18000',
                'status' => 'unpaid'
            ],
        ];

        foreach ($datas as $value) {
            Payment::create($value);
        }

    }
}
