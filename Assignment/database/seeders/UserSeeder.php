<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();


        $users = [
            [
                'name' => 'Ngo Quoc Dat',
                'email' => 'datlechin@gmail.com',
                'password' => '123456',
            ],
            [
                'name' => 'ChatGPT',
                'email' => 'chatgpt@openai.com',
                'password' => fake()->password(),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'email_verified_at' => Carbon::now(),
            ]);
        }
    }
}
