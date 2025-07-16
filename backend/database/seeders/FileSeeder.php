<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\File;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Getting the first user or creating a new one
        $user = User::first() ?? User::factory()->create();

        // Creating 10 files
        File::factory()
            ->count(10)
            ->for($user)
            ->create();
    }
}
