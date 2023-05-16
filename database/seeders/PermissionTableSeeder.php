<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'plan-list',
            'plan-create',
            'plan-edit',
            'plan-delete',
            'get-role',
            'get-roles',
            'delete-selected-role',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'get-order',
            'get-orders',
            'staff-list',
            'staff-create',
            'staff-edit',
            'staff-delete',
            'get-staff',
            'get-staffs',
            'staff',
            'orders',
            'rates',
            'setting',
            
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
