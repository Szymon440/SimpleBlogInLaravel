<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CommentTest extends TestCase
{

    use WithoutMiddleware;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guest_cant_delete_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create(
            [
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);

        $this->delete(route('comments.destroy', $comment))
            ->assertStatus(403);

        $comment->delete();
        $post->delete();
        $user->delete();
    }

    public function test_non_admin_cannot_delete_other_users_comment(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $otherUser->id]);

        $comment = Comment::factory()->create(
            [
                'user_id' => $otherUser->id,
                'post_id' => $post->id,
            ]);

        $this->actingAs($user)
            ->delete(route('comments.destroy', $comment))
            ->assertStatus(403);

        $comment->delete();
        $post->delete();
        $user->delete();
    }
}
