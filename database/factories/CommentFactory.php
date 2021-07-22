<?php

namespace Database\Factories;

use App\Models\Comment;
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
        return [
            'post_id' => rand(1,450),
            'user_id' => rand(1,100),
            'comment_text' => $this->faker->text,
            'comment_id' => $this->faker->randomElement($commentsIds)
        ];
    }
}
