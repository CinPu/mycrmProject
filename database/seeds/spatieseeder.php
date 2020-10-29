<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class spatieseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Create']);
        Permission::create(['name' => 'Edit']);
        Permission::create(['name' => 'Delete']);
        $role = Role::create(['name' => 'SuperAdmin']);
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Agent']);
        $role = Role::create(['name'=>'Employee']);
    }
}
