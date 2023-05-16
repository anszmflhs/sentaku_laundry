<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'read-role',
            'update-role',
            'delete-role',
            'create-role-permission',
            'read-role-permission',
            'update-role-permission',
            'delete-role-permission',
            'create-permission',
            'read-permission',
            'update-permission',
            'delete-permission',
            'create-bank',
            'read-bank',
            'update-bank',
            'delete-bank',
            'create-job',
            'read-job',
            'update-job',
            'delete-job',
            'create-resign',
            'read-resign',
            'update-resign',
            'delete-resign',
            'create-manager',
            'read-manager',
            'update-manager',
            'delete-manager',
            'create-contract',
            'read-contract',
            'update-contract',
            'delete-contract',
            'create-salary',
            'read-salary',
            'update-salary',
            'delete-salary',
            'create-payroll',
            'read-payroll',
            'update-payroll',
            'delete-payroll',
            'create-employee',
            'read-employee',
            'update-employee',
            'delete-employee',
            'create-user',
            'read-user',
            'update-user',
            'delete-user',
            'create-user-role',
            'read-user-role',
            'update-user-role',
            'delete-user-role',
        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role = Role::where('name', 'admin')->first();
        $role->syncPermissions($permissions);
    }
}
