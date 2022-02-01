<?php

namespace App\Console\Commands;

use App\Repositories\BlogPostRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CachePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to cache posts when need arises';
    /**
     * @var BlogPostRepository
     */
    private $postRepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(BlogPostRepository $postRepository)
    {
        parent::__construct();

        $this->postRepo = $postRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Clearing posts cache....');
        //clear both asc and desc order post
        Cache::forget('posts_desc');
        Cache::forget('posts_asc');

        $this->info('Cache cleared! Caching records....');

        //Re-fetch blog posts to update filter
        $this->postRepo->all();
        $this->postRepo->all('asc');

        $this->info('Caching posts complete');
    }
}
