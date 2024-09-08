<?php

namespace Database\Factories;

use App\Enums\PostType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(rand(3, 5));

        return [
            'title' => $title,
            'slug' => str()->slug($title),
            'excerpt' => fake()->sentence(rand(3, 5)),
            'type' => Arr::random(PostType::values()),
            'external' => rand(0, 5) ? null : '',
            'published_at' => rand(0, 1) ? null : Carbon::now()->subDays(rand(0, 365)),
        ];
    }
}
