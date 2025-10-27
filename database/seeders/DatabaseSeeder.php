<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Portfolio;
use App\Models\PortfolioType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin123',
        ]);

        PortfolioType::factory(1)->create();
        Portfolio::factory(100)->create();
        Blog::factory(100)->create();
    }
}
