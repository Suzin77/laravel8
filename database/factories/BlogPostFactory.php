<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraph(5,true),
            'created_at' => $this->faker->dateTimeBetween('-3 months','now'),
        ];
    }

    public function definedBlogPost()
    {
        return $this->state(function (array $attributes){
            return [
                'title' => 'defined title',
                'content' => 'defined content'
            ];
        });
    }
}
