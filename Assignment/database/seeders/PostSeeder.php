<?php

namespace Database\Seeders;

use App\Models\Discussion;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::truncate();

        $discussionsCount = Discussion::count();
        $usersCount = User::count();

        foreach (range(1, 500) as $i) {
            Post::create([
                'discussion_id' => rand(1, $discussionsCount),
                'user_id' => rand(1, $usersCount),
                'content' => fake()->realText(rand(200, 1000)),
                'ip_address' => fake()->ipv4(),
            ]);
        }
    }
}
