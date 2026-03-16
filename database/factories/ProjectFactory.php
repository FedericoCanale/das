<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $techStack = ['PHP', 'Laravel', 'Vue.js', 'React', 'MySQL', 'JavaScript', 'Bootstrap', 'Tailwind CSS', 'Node.js', 'PostgreSQL'];

        return [
            'title' => fake()->sentence(3, false),
            'type_id' => Type::inRandomOrder()->first()?->id,
            'description' => fake()->paragraph(3),
            'image' => null,
            'github_url' => fake()->url(),
            'live_url' => fake()->url(),
            'technologies' => implode(', ', fake()->randomElements($techStack, rand(2, 4))),
        ];
    }
}
