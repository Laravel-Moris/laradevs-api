<?php

namespace Database\Seeders;

use App\Models\Developer;
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
        User::factory(10)
            ->create();

        Developer::factory(5)
            ->afterCreating(function (Developer $developer) {
                $developer
                    ->createdBy()
                    ->associate(User::inRandomOrder()->first())
                    ->save();
            })
            ->create();
    }
}
