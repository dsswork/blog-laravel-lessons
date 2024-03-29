<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sergii',
            'email' => 'admin@admin.com',
            'password' => '12341234'
        ]);

        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            TagSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}
