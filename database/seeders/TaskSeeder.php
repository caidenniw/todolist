<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user first
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        $tasks = [
            [
                'user_id' => $user->id,
                'title' => 'Complete project proposal',
                'description' => 'Finish the Q2 project proposal and send it to the team',
                'priority' => 'high',
                'category' => 'work',
                'deadline' => now()->addDays(2),
                'is_completed' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Buy groceries',
                'description' => 'Milk, eggs, bread, vegetables',
                'priority' => 'medium',
                'category' => 'shopping',
                'deadline' => now()->addDay(),
                'is_completed' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Gym workout',
                'description' => 'Cardio and strength training',
                'priority' => 'low',
                'category' => 'health',
                'deadline' => now()->addHours(5),
                'is_completed' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Review code pull requests',
                'description' => 'Review and merge pending PRs from the team',
                'priority' => 'high',
                'category' => 'work',
                'deadline' => now()->addHours(3),
                'is_completed' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Read a book',
                'description' => 'Continue reading "Atomic Habits"',
                'priority' => 'low',
                'category' => 'personal',
                'deadline' => null,
                'is_completed' => true,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
