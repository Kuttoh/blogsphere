<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogPost;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;

class BlogPostController extends Controller
{
    /**
     * @var BlogPostRepository
     */
    private $postRepo;

    public function __construct(BlogPostRepository $postRepository)
    {
        $this->postRepo = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepo->all();

        return view('blog-posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        //create blog form
    }

    public function store(CreateBlogPost $request)
    {
        $validated = $request->except('_token');

        $validated['publication_date'] = now();

        $this->postRepo->store($validated);

        return back()->with('success', 'Blog post successfully published!');
    }

    public function show(BlogPost $blogPost)
    {
        return view('blog-posts.show', [
            'post' => $blogPost
        ]);
    }

    public function userPosts()
    {
        $author = auth()->user();

        $posts = $this->postRepo->getByAuthor($author->id);

        return view('blog-posts.my-posts', [
            'posts' => $posts
        ]);
    }
}
