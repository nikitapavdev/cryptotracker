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
        // Creating 10 files
        for($i = 0; $i < 50; $i++){
            File::factory()
                ->count(2)
                ->for(User::inRandomOrder()->first())
                ->create();
        }

    }
}
