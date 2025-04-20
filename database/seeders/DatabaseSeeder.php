<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Théo',
            'email' => 'hello@theoo.dev',
            'password' => env('DEFAULT_USER_PASSWORD'),
        ]);

        if (app()->isProduction()) {
            return;
        }

        $this->call([
            LinkSeeder::class,
            NoteSeeder::class,
        ]);
    }
}
