<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Database\Seeders\CommonSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CommonSeeder::class,
        ]);
    }
}
