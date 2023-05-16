<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11223344')
        ])

        ;
        $user1->assignRole('admin');
        $user2 = User::create([
            'name' => 'karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('11223344')
        ])

        ;
        $user2->assignRole('karyawan');

        $user3 = User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('11223344')
        ]);
        $user3->assignRole('customer');
    }
}
