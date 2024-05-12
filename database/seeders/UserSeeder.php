<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {


        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'a7med almajani',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'roles_name' => ["Admin"],
            'Status' => 'valued',
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
