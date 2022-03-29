<?php

namespace App\Http\Controllers;

use App\Events\BlogPostHasBeenCreated;
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
        $sort = \request()->has('sort') ? \request()->get('sort') : 'desc';

        $posts = $this->postRepo->all($sort);

        return view('blog-posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('blog-posts.create');
    }

    public function store(CreateBlogPost $request)
    {
        $validated = $request->except('_token');

        $validated['publication_date'] = now();
        $validated['author_id'] = auth()->id();

        $this->postRepo->store($validated);

        //Raise event ot update cache
        //Queue the event listener the task will be intensive
        // BlogPostHasBeenCreated::dispatch();

        return redirect(route('posts.user'))->with('success', 'Blog post successfully published!');
    }

    public function show(BlogPost $blogPost)
    {
        $next = $this->postRepo->next($blogPost->id);
        $prev = $this->postRepo->previous($blogPost->id);

        return view('blog-posts.show', [
            'post' => $blogPost,
            'next' => $next,
            'prev' => $prev
        ]);
    }

    public function userPosts()
    {
        $author = auth()->user();

        $posts = $this->postRepo->getByAuthor($author->id);

        return view('blog-posts.user-posts', [
            'posts' => $posts
        ]);
    }
}
