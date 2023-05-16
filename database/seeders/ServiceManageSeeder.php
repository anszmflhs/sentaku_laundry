<?php

namespace Database\Seeders;

use App\Models\ServiceManage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceManageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'user_id' => '1',
                'title' => 'Dry Cleaning',
            ],
            [
                'user_id' => '2',
                'title' => 'Washing',
            ],
            [
                'user_id' => '3',
                'title' => 'Ironning',
            ],
        ];

        foreach ($datas as $value) {
            ServiceManage::create($value);
        }

    }
}
