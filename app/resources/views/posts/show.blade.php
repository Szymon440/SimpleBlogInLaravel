<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $post->title }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('posts.index') }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    All Posts
                </a>
                <a href="{{ route('posts.myPosts') }}"
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    My Posts
                </a>
                <a href="{{ route('posts.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Add Post
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 p-8">
                <h1 class="text-4xl text-white mb-6">{{ $post->title }}</h1>
                <p class="text-white mb-4">{{ $post->content }}</p>
                <p class="text-gray-400">Author: {{ $post->user->name }}</p>
                <p class="text-gray-500">{{ $post->created_at }}</p>
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                          style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('posts.edit', $post->id) }}"
                           class="btn btn-primary text-white mt-4 mb-4">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white">Delete</button>
                    </form>
                @endcan

                <h3 class="text-2xl text-white mt-10">Comments</h3>
                <div class="mt-6">
                    @foreach($post->comments as $comment)
                        <div class="bg-gray-800 p-4 mb-4">
                            <p class="text-white">{{ $comment->comment }}</p>
                            <p class="text-gray-400 text-sm">Posted by {{ $comment->user->name ?? 'Guest' }}
                                on {{ $comment->created_at }}</p>
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-lg">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>

                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                    @csrf
                    <textarea name="comment" rows="4" class="w-full bg-gray-700 text-black p-4 rounded"
                              placeholder="Add a comment"></textarea>
                    <button type="submit"
                            class="bg-gray-800 mt-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                        Comment
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
