<?php

namespace Database\Seeders;

use App\Models\Subseenit;
use Illuminate\Database\Seeder;

class SubseenitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subseenit::factory()->times(100)->create();
    }
}
