<?php

namespace Database\Seeders;

use App\Models\CommentVote;
use Illuminate\Database\Seeder;

class CommentVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentVote::factory()->times(500)->create();
    }
}
