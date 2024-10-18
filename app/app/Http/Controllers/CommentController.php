<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate(['comment' => 'required']);

        $post = Post::findOrFail($id);
        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.show', $id)->with('success', 'Comment added.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (!Gate::allows('delete-comment', $comment)) {
            abort(403);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
