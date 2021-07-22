<?php

namespace Database\Factories;

use App\Models\CommentVote;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentVoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommentVote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $votes = [-1, 1];
        return [
            'comment_id' => rand(1, 200),
            'user_id' => rand(1, 100),
            'vote' => $votes[rand(0, 1)]
        ];
    }
}
