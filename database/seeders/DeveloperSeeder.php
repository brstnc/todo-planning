<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers = config('e-variable.developers');
        foreach ($developers as $developer) {
            Developer::create($developer);
        }
    }
}
