<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User; 

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'user_id' => User::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(), // Ini hanya contoh, Anda dapat menyesuaikan sesuai kebutuhan
        ];
    }
}

