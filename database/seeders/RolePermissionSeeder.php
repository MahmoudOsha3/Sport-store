<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Super Admin']) ;

        foreach (config('abilities') as $permission => $value) {
            RoleAbility::create([
                'role_id' => $role->id ,
                'ability' => $permission ,
                'type' => 'allow'
            ]) ;
        }
    }
}
