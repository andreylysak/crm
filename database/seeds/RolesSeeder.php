<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true
            ]
        ]);
        $user = Role::create([
            'name' => 'User', 
            'slug' => 'user',
            'permissions' => [
                'view' => true
            ]
        ]);
    }
}
