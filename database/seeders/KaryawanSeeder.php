<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Ahmad',
                'contact' => '092309293',
                'hire_date' => date('Y-m-d'),
                'gender' => 'L',
                'address' => 'Indonesia',
                'photo' => 'https://indonesiaexpat.id/wp-content/uploads/2017/10/img_6172.jpg',
                'service_manage_id' => '1',
                'user_id' => '1'
            ],
            [
                'name' => 'Udin',
                'contact' => '0829292',
                'hire_date' => date('Y-m-d'),
                'gender' => 'L',
                'address' => 'Indonesia',
                'photo' => 'https://indonesiaexpat.id/wp-content/uploads/2017/10/img_6172.jpg',
                'service_manage_id' => '2',
                'user_id' => '2'
            ],
            [
                'name' => 'Jainab',
                'contact' => '0627221',
                'hire_date' => date('Y-m-d'),
                'gender' => 'P',
                'address' => 'Indonesia',
                'photo' => 'https://indonesiaexpat.id/wp-content/uploads/2017/10/img_6172.jpg',
                'service_manage_id' => '3',
                'user_id' => '3'
            ],
        ];

        foreach ($datas as $value) {
            Karyawan::create($value);
        }

    }
}
