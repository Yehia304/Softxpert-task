<?php

namespace Database\Factories;

use App\Domain\Task\Enums\TaskStatus;
use App\Domain\Task\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(50),
            'due_date' => fake()->dateTimeThisMonth(),
            'status'=> TaskStatus::PENDING,
            'user_id' => rand(1,10)
        ];
    }
}
