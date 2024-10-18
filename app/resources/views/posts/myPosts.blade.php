<!-- resources/views/posts/my-posts.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Posts') }}
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
            <div class="bg-gray-900 min-h-screen p-8">
                <div class="container mx-auto">
                    <h1 class="text-4xl text-white mb-6 text-center">My Posts</h1>
                    @if ($posts->isEmpty())
                        <p class="text-white text-center">You have not created any posts yet.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($posts as $post)
                                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                                    <h1 class="text-3xl text-white mb-4 text-center font-bold">{{ $post->title }}</h1>
                                    <p class="text-white mb-4 text-base">{{ $post->content }}</p>
                                    <p class="text-gray-400 text-sm">Created at: <span
                                            class="font-semibold">{{ $post->created_at }}</span></p>

                                    <div class="mt-4 text-center">
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                              style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg"
                                                    onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-white">View Post</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
