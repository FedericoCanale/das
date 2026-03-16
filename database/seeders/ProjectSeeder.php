<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $technologyIds = Technology::pluck('id')->toArray();

        Project::factory()->count(10)->create()->each(function ($project) use ($technologyIds) {
            $project->technologies()->attach(
                fake()->randomElements($technologyIds, rand(2, 5))
            );
        });
    }
}
