<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the user seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'       => 'Administrator',
            'email'      => 'admin@domain.com',
            'password'   => bcrypt('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole('administrator');
    }
}
