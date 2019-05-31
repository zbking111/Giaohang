<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
           [
               'name' => 'units',
               'display_name' => 'Units Manager',
               'permissions' => [
                   ['name' => 'units.read'  , 'display_name' => 'Read'],
                   ['name' => 'units.create', 'display_name' => 'Create units'],
                   ['name' => 'units.update', 'display_name' => 'Update units'],
                   ['name' => 'units.delete', 'display_name' => 'Delete units'],
               ]
           ],
           [
               'name' => 'orders',
               'display_name' => 'Units Manager',
               'permissions' => [
                   ['name' => 'order.approve'  , 'display_name' => 'Approve'],
                   ['name' => 'order.shipped', 'display_name' => 'Shipped'],
               ]
           ],
           [
               'name' => 'setting',
               'display_name' => 'Setting',
               'permissions' => [
                   ['name' => 'setting.contact.read'  , 'display_name' => 'Setting contact'],
                   ['name' => 'setting.seoDefault.read', 'display_name' => 'Setting Seo'],
               ]
           ],
           [
               'name' => 'customer',
               'display_name' => 'Active customer',
               'permissions' => [
                   ['name' => 'customer.active'  , 'display_name' => 'Active customer'],
                   ['name' => 'customer.read'  , 'display_name' => 'Read customer'],
               ]
           ],


        ];

        foreach ($array as $key => $item) {
            $idPermission = DB::table('permission_group')->insertGetId(
                array( 'name' => $item['name'], 'display_name' => $item['display_name'])
            );
            foreach ($item['permissions'] as $key2 => $item2) {
                DB::table('permissions')->insert(
                    array('name' => $item2['name']  , 'display_name' => $item2['display_name']  , 'permission_group_id' => $idPermission)
                );
            }
        }
    }
}
