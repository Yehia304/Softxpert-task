<?php

namespace Database\Seeders;

use App\Domain\Task\Models\Task;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    public function run()
    {
        Task::factory(10)->create();
    }
}
