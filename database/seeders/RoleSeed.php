<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Role::count() > 0) return null;
        Role::create(["name"=>"superadmin"]);
        Role::create(["name"=>"admin"]);
        Role::create(["name"=>"pengelola"]);
        Role::create(["name"=>"umkm"]);
    }
}
