<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function ($post) {
            Comment::factory(3)->create([
                'post_id' => $post->id,
                'user_id' => $post->user_id,
            ]);
        });
    }
}
