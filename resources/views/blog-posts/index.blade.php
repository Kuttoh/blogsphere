@extends('layouts.minimal')
@section('title', 'Posts')
@section('content')
    <!-- component -->
    <div class="overflow-x-hidden bg-gray-100">
        <div class="px-6 py-8">
            <div class="container flex justify-between mx-auto">
                <div class="w-full">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Posts</h1>
                        <div>
                            <label>Sort Date
                                <select
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option>Latest</option>
                                    <option>Oldest</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    @include('partials.blog-list')
                </div>
            </div>
        </div>
    </div>
@endsection
