<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SubseenitSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            PostVoteSeeder::class,
            CommentVoteSeeder::class
        ]);
    }
}
