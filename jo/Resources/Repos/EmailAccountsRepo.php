<?php

namespace Jo\Resources\Repos;

use Auth;
use App\Models\EmailAccount;
use Jo\Abstracts\AbstractRepository;

class EmailAccountsRepo extends AbstractRepository
{
    public function __construct(EmailAccount $model)
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
