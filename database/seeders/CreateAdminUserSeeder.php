<?php

namespace Database\Seeders;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@domain.com',
            'password' => bcrypt('123456'),
            'is_admin' => '1',
            'assign_role' => '1',
            'user_type' => 'admin',
        ]);
        $user1 = User::create([
            'name' => 'Company', 
            'email' => 'company@domain.com',
            'password' => bcrypt('123456'),
            'is_admin' => '0',
            'assign_role' => '2',
            'user_type' => 'company',
        ]);
        $user2 = User::create([
            'name' => 'user', 
            'email' => 'user@domain.com',
            'password' => bcrypt('123456'),
            'is_admin' => '0',
            'assign_role' => '3',
            'user_type' => 'user',
        ]);
        
        $role  = Role::create(['name' => 'Admin']);
        $role1 = Role::create(['name' => 'Company']);
        $role2 = Role::create(['name' => 'user']);

        $permissions = Permission::get();
        
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }
    
        $user->assignRole($role->name);
        $user1->assignRole($role1->name);
        $user2->assignRole($role2->name);
    }
}
