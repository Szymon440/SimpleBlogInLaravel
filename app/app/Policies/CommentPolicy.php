<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Comment $comment): bool
    {
        //
    }


    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Comment $comment): bool
    {
        //
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id ||
            $user->id === $comment->post->user_id ||
            $user->hasRole('admin');
    }

    public function restore(User $user, Comment $comment): bool
    {
        //
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        //
    }
}
