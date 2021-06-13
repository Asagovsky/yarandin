<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\StatusSeeder;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(2)->hasProjects(2)->hasTasks(5)->create();
        $this->call([
            StatusSeeder::class
        ]);
        
        User::factory(2)->has(Project::factory(2)->has(Task::factory(8)))->create();
    }
}
