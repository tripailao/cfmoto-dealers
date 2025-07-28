<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleCollaborator = Role::create(['name' => 'collaborator']);
        $roleDealer = Role::create(['name' => 'dealer']);
        $roleService = Role::create(['name' => 'service']);

        // $permissionsDealer = [
        //     'vehicles.index',
        //     'vehicles.show',
        // ];

        // foreach ($permissionsDealer as $permission) {
        //     Permission::firstOrCreate(['name' => $permission]);
        // }

        // $roleDealer->syncPermissions($permissionsDealer);

    }
}
