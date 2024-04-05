<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'category',
            'create_category',
            'edit_category',
            'delete_category',
            'sub_category',
            'create_sub_category',
            'edit_sub_category',
            'delete_sub_category',
            'measuring_units',
            'create_measuring_units',
            'edit_measuring_units',
            'delete_measuring_units',
            'subscriptions',
            'create_subscriptions',
            'edit_subscriptions',
            'delete_subscriptions',
            'product',
            'create_product',
            'edit_product',
            'delete_product',
            'customers',
            'create_customer',
            'edit_customer',
            'delete_customer',
            'admin',
            'create_admin',
            'edit_admin',
            'delete_admin',
            'role',
            'create_role',
            'edit_role',
            'delete_role',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
    }
}
