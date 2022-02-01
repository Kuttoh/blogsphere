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
                        <a href="{{ route('post.create') }}"
                           class="bg-white hover:bg-green-600 hover:text-white text-gray-800 font-semibold py-2 px-4 border rounded shadow">+
                            New</a>
                    </div>
                    @include('partials.blog-list')
                </div>
            </div>
        </div>
    </div>
@endsection
