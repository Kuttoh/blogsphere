<?php

namespace App\Jobs;

use App\Exceptions\UserNotFoundException;
use App\Feeds\FeedShuttle;
use App\Models\BlogPost;
use App\Models\PostFetchStats;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchBlogPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $admin;

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
        try {
            $this->admin = User::whereLastName('admin')->firstOrFail();
        } catch (ModelNotFoundException $exception){
            throw new UserNotFoundException('Could not find admin user. Please create one before fetching posts. Time: '.now());
        }

        $posts = FeedShuttle::getBlogPosts();

        //get a hash for these posts, then compare with hash from previous fetches
        //if they match, then there's no new posts, if they don't, then new posts exist
        $hash = sha1($posts);

        //there exists a risk of sha-1 collisions
        $exits = PostFetchStats::where('hash', $hash)->exists();

        if (!$exits){
            $this->createPosts($posts);

            $this->createFetchStat($hash);
        }
    }

    private function createPosts($posts)
    {
        $content = json_decode($posts, true);

        foreach ($content['data'] as $post) {
            //skip missing required params
            if (array_key_exists('title', $post)
                && array_key_exists('description', $post)
                && array_key_exists('publication_date', $post)){

                //assumed title is unique, no need to create if it exists
                //TODO - if posts from feed can be updated, then possibly compare by hash for each record(will require hash column in blog_posts table)
                if (BlogPost::whereTitle($post['title'])->exists()){
                    continue;
                }

                $post['author_id'] = $this->admin->id;
                BlogPost::create($post);
            }
        }
    }

    private function createFetchStat($hash)
    {
        PostFetchStats::create(['hash' => $hash]);
    }
}
