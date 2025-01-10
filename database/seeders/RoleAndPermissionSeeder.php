<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ownerRole = Role::create(['name' => 'owner']);
        $organizerRole = Role::create(['name' => 'organizer']);
        $adminRole = Role::create(['name' => 'admin']);

        $permissions = [
            'manage organizers', // Owner
            'approve events', // Owner
            'manage orders', // Owner
            'manage talents', // Organizer
            'manage categories', // Organizer
            'manage events', // Organizer
            'insert ticket categories', // Organizer
            'insert payment', // Organizer
            'manage admin', // Organizer
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $ownerRole->givePermissionTo(['manage organizers', 'approve events', 'manage orders']);
        $organizerRole->givePermissionTo(['manage talents', 'manage categories', 'manage events', 'insert ticket categories', 'insert payment', 'manage admin']);
        $adminRole->givePermissionTo(['manage orders']);
    }
}
