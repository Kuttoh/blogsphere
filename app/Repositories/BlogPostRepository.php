<?php

namespace App\Repositories;

use App\Models\BlogPost;

class BlogPostRepository extends BaseRepository
{

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
        return $this->model->with(['author:id,last_name,first_name'])
            ->orderBy('publication_date', $sortDirection)
            ->cursorPaginate(15);
    }

    public function getByAuthor($userId, $sortDirection = 'desc')
    {
        return $this->model->with(['author:id,last_name,first_name'])
            ->where('author_id', $userId)
            ->orderBy('publication_date', $sortDirection)
            ->cursorPaginate(15);
    }
}
