<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $commentsIds = Comment::all()->pluck('id')->toArray();
        $usersId = User::all()->pluck('id')->toArray();
        $postsId = Post::all()->pluck('id')->toArray();
        return [
            'post_id' => $this->faker->randomElement($postsId),
            'user_id' => $this->faker->randomElement($usersId),
            'comment_text' => $this->faker->text,
            'comment_id' => $this->faker->randomElement($commentsIds),
            'votes' => rand(-5000, 5000)
        ];
    }
}
