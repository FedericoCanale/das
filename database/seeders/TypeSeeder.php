<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Web Design', 'Graphic Design', 'Back End', 'Full Stack', 'Mobile'];

        foreach ($types as $type) {
            Type::create(['name' => $type]);
        }
    }
}
