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

    public function all(): Collection
    {
        return $this->model->with(['author:id,full_name'])->get();
    }
}
