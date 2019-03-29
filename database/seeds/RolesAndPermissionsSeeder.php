<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

/*
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'cityManager']);
        Permission::create(['name' => 'gymManager']);

        $permission = Permission::create(['name' => 'addUser']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        */
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'cityManager']);
        $role = Role::create(['name' => 'gymManager']);
        
    }
}
