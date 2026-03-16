<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            'PHP',
            'Laravel',
            'JavaScript',
            'Vue.js',
            'React',
            'MySQL',
            'Bootstrap',
            'Tailwind CSS',
            'Node.js',
            'HTML',
            'CSS',
            'Python',
        ];

        foreach ($technologies as $name) {
            Technology::create(['name' => $name]);
        }
    }
}
