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
        //fetch blog posts
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
        //show blogpost
    }
}
