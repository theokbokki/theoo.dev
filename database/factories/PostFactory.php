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
        $title = fake()->unique()->sentence(rand(3, 6));

        return [
            'title' => $title,
            'slug' => str()->slug($title),
            'excerpt' => fake()->sentence(rand(3, 6)),
            'type' => Arr::random(PostType::values()),
            'published_at' => Carbon::now()->subDays(rand(0, 365)),
        ];
    }
}
