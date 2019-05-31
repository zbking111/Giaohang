<?php

use Illuminate\Database\Seeder;

use DangKien\Database\Seeds\RolePermissionSeed;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeed::class);
        $this->call(PermissionSeed::class);
    }
}
