<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostVoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostVote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usersId = User::all()->pluck('id')->toArray();
        $postsId = Post::all()->pluck('id')->toArray();
        $votes = [-1, 1];
        return [
            'post_id' => $this->faker->randomElement($postsId),
            'user_id' => $this->faker->randomElement($usersId),
            'vote' => $votes[rand(0, 1)]
        ];
    }
}
