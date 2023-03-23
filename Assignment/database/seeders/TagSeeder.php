<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::truncate();

        $tags = [
            'PHP',
            'Javascript',
            'Laravel',
            'Vue',
            'Development',
            'Design',
            'TailwindCSS',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
                'color' => fake()->hexColor(),
            ]);
        }
    }
}
