<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the roles seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name' => 'administrator']);
    }
}
