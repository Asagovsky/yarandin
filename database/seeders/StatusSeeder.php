<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TaskStatus;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!TaskStatus::where('name', 'New')->exists()) {
            $status = new TaskStatus();
            $status->name = 'New';
            $status->save();
        }
        if (!TaskStatus::where('name', 'In progress')->exists()) {
            $status = new TaskStatus();
            $status->name = 'In progress';
            $status->save();
        }
        if (!TaskStatus::where('name', 'Done')->exists()) {
            $status = new TaskStatus();
            $status->name = 'Done';
            $status->save();
        }
    }
}
