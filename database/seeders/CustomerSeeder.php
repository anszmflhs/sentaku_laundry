<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'user_id' => '1',
                'nohp' => '015103',
                'alamat' => 'Indonesia',
                'status' => 'Inactive'
            ],
            [
                'user_id' => '2',
                'nohp' => '025103',
                'alamat' => 'Indonesia',
                'status' => 'Inactive'
            ],
            [
                'user_id' => '3',
                'nohp' => '035103',
                'alamat' => 'Indonesia',
                'status' => 'Inactive'
            ],
        ];

        foreach ($datas as $value) {
            Customer::create($value);
        }

    }
}
