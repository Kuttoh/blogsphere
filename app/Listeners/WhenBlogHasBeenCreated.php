<?php

namespace App\Listeners;

use App\Events\BlogPostHasBeenCreated;
use App\Repositories\BlogPostRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class WhenBlogHasBeenCreated implements ShouldQueue
{
    /**
     * @var BlogPostRepository
     */
    private $postRepo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BlogPostRepository $postRepository)
    {
        $this->postRepo = $postRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BlogPostHasBeenCreated  $event
     * @return void
     */
    public function handle(BlogPostHasBeenCreated $event)
    {
        //clear both asc and desc order post
        Cache::forget('posts_desc');
        Cache::forget('posts_asc');

        //Re-fetch blog posts to update filter
        $this->postRepo->all();
        $this->postRepo->all('asc');
    }
}
