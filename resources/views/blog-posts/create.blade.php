@extends('layouts.minimal')
@section('title', 'Create')
@section('content')
    <div class="overflow-x-hidden bg-gray-100">
        <div class="px-6 py-8">
            <div class="container flex justify-between mx-auto">
                <div class="w-full">
                    <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mt-10">
                        <div class="bg-white w-full shadow rounded p-8 sm:p-12">
                            <div class="flex items-center justify-between">
                                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Create Post</h1>
                            </div>
                            <div>
                                <form action="{{ route('post.store') }}" method="post">
                                    @csrf
                                    <div class="md:flex items-center mt-8">
                                        <div class="w-full flex flex-col">
                                            <label class="font-semibold leading-none" for="title">Title</label>
                                            <input type="text" name="title" id="title"
                                                   placeholder="e.g Lorem Ipsum Dolor Sit Amet"
                                                   class="leading-none text-gray-900 p-3 focus:outline-none mt-4 bg-gray-100 border rounded border-gray-200"
                                                   required/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="w-full flex flex-col mt-8">
                                            <label for="description"
                                                   class="font-semibold leading-none">Description</label>
                                            <textarea id="description" type="text" name="description"
                                                      class="h-40 text-base leading-none text-gray-900 p-3 focus:oultine-none mt-4 bg-gray-100 border rounded border-gray-200"
                                                      required></textarea>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center w-full">
                                        <button
                                            class="mt-9 font-semibold leading-none text-black py-4 px-10 bg-white border rounded hover:bg-green-600 hover:text-white focus:ring-2 focus:ring-offset-2 focus:outline-none">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
