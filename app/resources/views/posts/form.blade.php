<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post ? __('Edit Post') : __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 p-8">
                <form action="{{ $post ? route('posts.update', $post->id) : route('posts.store') }}" method="POST">
                    @csrf
                    @if($post)
                        @method('PUT')
                    @endif

                    <div class="mb-6">
                        <label for="title" class="block text-white">Title</label>
                        <input type="text" name="title" id="title" value="{{ $post->title ?? '' }}"
                               class="w-full p-4 rounded bg-gray-700 text-black">
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-white">Content</label>
                        <textarea name="content" id="content" rows="4"
                                  class="w-full p-4 rounded bg-gray-700 text-black">{{ $post->content ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="bg-gray-800  hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $post ? 'Update Post' : 'Create Post' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
