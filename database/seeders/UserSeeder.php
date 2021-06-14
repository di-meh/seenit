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
        User::factory([
            'name' => 'Admin Admin',
            'username' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
            'is_admin'=>true
        ])->create();
        User::factory()->times(150)->create();
    }
}
