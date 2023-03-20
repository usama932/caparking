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
        
        $role = Role::create(['name' => 'Admin']);
        

        $permissions = Permission::get();
        
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }
    
        $user->assignRole($role->name);
    }
}
