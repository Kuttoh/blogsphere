<?php

namespace App\Repositories;

use App\Models\BlogPost;
use Illuminate\Support\Collection;

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

    public function all()
    {
        return $this->model->with(['author:id,last_name,first_name'])->paginate(15);
    }

    public function getByAuthor($userId)
    {
        return $this->model->with(['author:id,last_name,first_name'])->where('author_id', $userId)->paginate(15);
    }
}
