<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'email' => 'admin@admin.com',
            'phone' => '099999990',
            'full_name' => 'Administrator',
            'password' => bcrypt('123123123'),
        ]);
        User::create([
            'role_id' => 3,
            'email' => 'coach@coach.com',
            'phone' => '0999999933',
            'full_name' => 'Coach',
            'password' => bcrypt('123123123'),
        ]);
    }
}
