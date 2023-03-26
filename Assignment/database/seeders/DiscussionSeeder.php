<?php

namespace Database\Seeders;

use App\Models\Discussion;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    public function run(): void
    {
        Discussion::truncate();

        $usersCount = User::count();
        $tagsCount = Tag::count();

        foreach (range(1, 50) as $i) {
            $discussion = Discussion::create([
                'user_id' => rand(1, $usersCount),
                'title' => fake()->realText(rand(20, 50)),
                'slug' => fake()->slug(),
            ]);

            $discussion->tags()->sync([rand(1, $tagsCount)]);
        }
    }
}
