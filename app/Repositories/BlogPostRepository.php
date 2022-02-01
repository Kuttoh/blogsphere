<?php

namespace App\Repositories;

use App\Models\BlogPost;
use App\Traits\CachePaginator;
use Illuminate\Support\Facades\Cache;

class BlogPostRepository extends BaseRepository
{
    use CachePaginator;

    /**
     * BlogPost constructor.
     *
     * @param BlogPost $model
     */
    public function __construct(BlogPost $model)
    {
        parent::__construct($model);
    }

    public function all($sortDirection = 'desc')
    {
        //Cache forever, then use model observers or events to update cache
        $key = 'posts_' . $sortDirection;
        $posts = Cache::rememberForever($key, function () use ($sortDirection) {
            return $this->model->with(['author:id,last_name,first_name'])
                ->orderBy('publication_date', $sortDirection)
                ->get();
        });

        return $this->paginate($posts);
    }

    public function getByAuthor($userId, $sortDirection = 'desc')
    {
        // cache forever then use model observer to update cache
        $key = 'posts_' . $userId . '_' . $sortDirection;
        $userPosts = Cache::rememberForever($key, function () use ($userId, $sortDirection) {
            return $this->model->with(['author:id,last_name,first_name'])
                ->where('author_id', $userId)
                ->orderBy('publication_date', $sortDirection)
                ->get();
        });

        return $this->paginate($userPosts);
    }
}
