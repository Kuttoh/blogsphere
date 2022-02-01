<?php

namespace App\Listeners;

use App\Events\BlogPostHasBeenCreated;
use App\Repositories\BlogPostRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class WhenBlogHasBeenCreated
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
        Cache::forget('posts_desc');
        Cache::forget('posts_asc');

        $this->postRepo->all();
        $this->postRepo->all('asc');
    }
}
