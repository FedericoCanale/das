<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $techStack = ['PHP', 'Laravel', 'Vue.js', 'React', 'MySQL', 'JavaScript', 'Bootstrap', 'Tailwind CSS', 'Node.js', 'PostgreSQL'];

        return [
            'title' => fake()->sentence(3, false),
            'type' => fake()->randomElement(['Web Design', 'Graphic Design', 'Back End', 'Full Stack', 'Mobile']),
            'description' => fake()->paragraph(3),
            'image' => null,
            'github_url' => fake()->url(),
            'live_url' => fake()->url(),
            'technologies' => implode(', ', fake()->randomElements($techStack, rand(2, 4))),
        ];
    }
}
