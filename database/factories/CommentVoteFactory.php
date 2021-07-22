<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\User;
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
        $commentsIds = Comment::all()->pluck('id')->toArray();
        $usersId = User::all()->pluck('id')->toArray();
        return [
            'comment_id' => $this->faker->randomElement($commentsIds),
            'user_id' => $this->faker->randomElement($usersId),
            'vote' => $votes[rand(0, 1)]
        ];
    }
}
