<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PostTest extends TestCase
{
    use WithoutMiddleware;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guest_cant_delete_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->delete(route('posts.destroy', $post))
            ->assertStatus(403);

        $post->delete();
        $user->delete();
    }

    public function test_non_admin_cannot_delete_other_users_posts(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $otherUser->id]);

        $this->actingAs($user)
            ->delete(route('posts.destroy', $post))
            ->assertStatus(403);

        $post->delete();
        $otherUser->delete();
        $user->delete();
    }

}
