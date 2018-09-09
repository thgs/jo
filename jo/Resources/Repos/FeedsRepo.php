<?php

namespace Jo\Resources\Repos;

use Auth;
use App\Models\Feed;
use Jo\Abstracts\AbstractRepository;

class FeedsRepo extends AbstractRepository
{
    public function __construct(Feed $model)
    {
        parent::__construct($model);
    }


    public function create($data)
    {
        // we check if user_id is set
        if (!isset($data['user_id']))
        {
            // and set it if we have to
            $data['user_id'] = \Auth::user()->id;
        }

        // return the model
        return $this->model->create($data);
    }
}
