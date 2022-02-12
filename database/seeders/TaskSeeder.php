<?php

namespace Database\Seeders;

use App\Models\Tasks;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = config('e-variable.tasks');
        foreach ($tasks as $task) {
            Tasks::create($task);
        }
    }
}
