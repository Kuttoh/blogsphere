<?php

namespace App\Jobs;

use App\Feeds\FeedShuttle;
use App\Models\BlogPost;
use App\Models\PostFetchStats;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function Composer\Autoload\includeFile;

class FetchBlogPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $posts = FeedShuttle::getBlogPosts();

        //get a hash for these posts, then compare with hash from previous fetch
        //if they match, then there's no new posts, if they don't, then new posts exist
        $hash = sha1($posts);

        //there exists a risk of sha-1 collisions
        $exits = PostFetchStats::where('hash', $hash)->exists();

        if (!$exits){
            $this->createPosts($posts);
        }
    }

    private function createPosts($posts)
    {
        $content = json_decode($posts, true);

        foreach ($content['data'] as $post) {
            //skip missing required params
            if (!in_array($post, ['title', 'description', 'publication_date'])){
                continue;
            }

            BlogPost::create([$post]);
        }
    }
}
