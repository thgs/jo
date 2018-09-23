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
        // create function here checks whether there is
        // another post_uid in the given feed
        $found = $this->model->where([
            'post_uid' => $data['post_uid'],
            'feed_id' => $data['feed_id']
        ])->first();

        // now what happens in the case post_uid is empty ?

        // return the model if not found already
        return ($found) ? false : $this->model->create($data);
    }
}
