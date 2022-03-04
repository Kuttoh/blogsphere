<?php

namespace App\Repositories;

use App\Models\BlogPost;
use App\Traits\CachePaginator;
use App\Traits\CollectionPaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BlogPostRepository extends BaseRepository
{
    use CollectionPaginator;

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
        // Enforce sort direction to be 'asc' or 'desc'
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])){
            $sortDirection = 'desc';
        }

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
        return $this->model->with(['author:id,last_name,first_name'])
            ->where('author_id', $userId)
            ->orderBy('publication_date', $sortDirection)
            ->cursorPaginate(15);
    }
}
