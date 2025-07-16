<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $filename = $this->faker->lexify('file_????') . '.pdf';

        return [
            'user_id' => User::factory(), 
            'original_name' => $filename,
            'custom_name' => $this->faker->optional()->sentence(2),
            's3_key' => function () use ($filename) {
                return $this->faker->numberBetween(1, 10) . '/' . Str::uuid() . '.pdf';
            },
            'mime_type' => 'application/pdf',
            'size' => $this->faker->numberBetween(100_000, 300_000),
            'is_public' => $this->faker->boolean(20),
        ]; 
    }
}
