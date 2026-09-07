<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'hello@theoo.dev',
            'password' => env('PASSWORD'),
        ]);

        $this->call([
            LinkSeeder::class,
            PostSeeder::class,
            AttachmentSeeder::class,
        ]);
    }
}
