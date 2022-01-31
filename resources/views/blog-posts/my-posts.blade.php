@extends('layouts.minimal')
@section('title', 'My Blogs')
@section('content')
    <!-- component -->
    <div class="overflow-x-hidden bg-gray-100">
        <div class="px-6 py-8">
            <div class="container flex justify-between mx-auto">
                <div class="w-full">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">My Posts</h1>
                        <button
                            class="bg-white hover:bg-green-300 text-gray-800 font-semibold py-2 px-4 border rounded shadow">
                            + New
                        </button>
                    </div>
                    @foreach($posts as $post)
                        <div class="mt-6">
                            <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-light text-gray-600">{{ date_format($post->publication_date, 'M d, Y') }}</span>
                                </div>
                                <div class="mt-2"><a href="{{ route('post.show', $post->id) }}"
                                                     class="text-2xl font-bold text-gray-700 hover:underline">{{ $post->title }}</a>
                                    <p class="mt-2 text-gray-600">{{ \Illuminate\Support\Str::limit($post->description) }}
                                        ...</p>
                                </div>
                                <div class="flex items-center justify-between mt-4"><a
                                        href="{{ route('post.show', $post->id) }}"
                                        class="text-blue-500 hover:underline">Read more</a>
                                    <div>
                                        <h1 class="font-bold text-gray-700 hover:underline">{{ $post->author->full_name }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
