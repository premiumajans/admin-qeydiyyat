<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'languages index',
            'languages create',
            'languages edit',
            'languages delete',
            'users index',
            'users create',
            'users edit',
            'users delete',
            'permissions index',
            'permissions create',
            'permissions edit',
            'permissions delete',
            'new-permission index',
            'new-permission create',
            'new-permission edit',
            'new-permission delete',
            'report index',
            'report delete',
            'information index',
            'information create',
            'information edit',
            'information delete',
            'dashboard index',
            'confirm-post',
            'team index',
            'slider index',
            'slider create',
            'slider edit',
            'slider delete',
            'service index',
            'service create',
            'service edit',
            'service delete',
            'why-choose-us index',
            'why-choose-us create',
            'why-choose-us edit',
            'why-choose-us delete',
            'packages index',
            'packages create',
            'packages edit',
            'packages delete',
            'package-components index',
            'package-components create',
            'package-components edit',
            'package-components delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
