<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 2,
            'email' => 'user@user.com',
            'phone' => '099999991',
            'full_name' => 'Normal User',
            'password' => bcrypt('123123123'),
        ]);
    }
}
