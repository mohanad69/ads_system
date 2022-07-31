<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         # adsa permissions
         $permissions = [
            'get_ads',
            'add_ads',
            'edit_ads',
            'delete_ads',
         ];
         foreach ($permissions as $item) {
            Permission::create(['name' => $item]);
         }
    }
}
