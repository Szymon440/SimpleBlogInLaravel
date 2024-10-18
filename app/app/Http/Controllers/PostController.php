<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::with('user')->latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.form', ['post' => null]);
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        auth()->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => now(),
        ]);

        return redirect()->route(route: 'posts.index');
    }

    public function show(Post $post): View
    {
        $post = Post::find($post->id);

        return view(view: 'posts.show', data: compact(var_name: 'post'));
    }

    public function edit(Post $post): View
    {
        return view('posts.form', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = Post::find($post->id);
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        return redirect()->route(route: 'posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (!Gate::allows('delete-post', $post)) {
            abort(403);
        }

        $post = Post::find($post->id);
        $post->delete();

        return redirect()->route(route: 'posts.index')
            ->with('success', 'Post deleted successfully');
    }

    public function myPosts(): View
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();

        return view(view: 'posts.myPosts', data: compact(var_name: 'posts'));
    }
}
