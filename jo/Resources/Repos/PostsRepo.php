<?php

namespace Jo\Resources\Repos;

use App\Models\Post;
use Jo\Abstracts\AbstractRepository;

class PostsRepo extends AbstractRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }


    public function create($data)
    {
        // return the model
        return $this->model->create($data);
    }
}
