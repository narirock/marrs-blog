<?php

namespace Database\Factories;

use Marrs\MarrsBlog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'seo_title' => $this->faker->sentence(),
            'publish' => '2020-01-01',
            'excerpt' => $this->faker->sentence(15),
            'body' => $this->faker->paragraph(8),
            'image' => '/i.picsum.photos/id/1011/5472/3648.jpg?hmac=Koo9845x2akkVzVFX3xxAc9BCkeGYA9VRVfLE4f0Zzk',
            'slug' => $this->faker->slug(),
            'category_id' => rand(1, 3),
            'status' => $this->faker->randomElement(['PUBLISHED', 'DRAFT', 'PENDING']),
            'author_id' => 1
        ];
    }
}
