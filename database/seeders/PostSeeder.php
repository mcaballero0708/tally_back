<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    public function run(): void
    {
        $user1 = User::where('email', 'john@example.com')->first();
        $user2 = User::where('email', 'jane@example.com')->first();
        $user3 = User::where('email', 'michael@example.com')->first();

        Post::create([
            'user_id' => $user1->id,
            'title' => 'First Post by John',
            'content' => 'This is the content of the first post.',
        ]);

        Post::create([
            'user_id' => $user2->id,
            'title' => 'First Post by Jane',
            'content' => 'This is the content of the first post by Jane.',
        ]);

        Post::create([
            'user_id' => $user3->id,
            'title' => 'Post by Michael',
            'content' => 'This is the content of the post.',
        ]);
    }
}
