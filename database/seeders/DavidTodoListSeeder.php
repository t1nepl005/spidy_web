<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\DavidTodoList;

class DavidTodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure we have users to attach todos to
        $users = User::all();
        if ($users->count() === 0) {
            $this->command->warn('⚠️ No users found. Creating 3 sample users first...');
            $users = User::factory()->count(3)->create();
        }

        $statuses = ['pending', 'doing', 'finished'];

        $records = [];

        foreach (range(1, 20) as $i) {
            $records[] = [
                'user_id' => $users->random()->id,
                'title' => 'Task #' . $i . ': ' . Str::title(fake()->words(3, true)),
                'details' => fake()->sentence(10),
                'status' => fake()->randomElement($statuses),
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now(),
            ];
        }

        DavidTodoList::insert($records);

        $this->command->info('✅ Inserted ' . count($records) . ' David Todo List records.');
    }
}
